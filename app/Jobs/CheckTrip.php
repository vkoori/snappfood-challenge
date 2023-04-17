<?php

namespace App\Jobs;

use App\Apis\Estimate\BaseEstimate;
use App\Apis\Trip\BaseTrip;
use App\Enums\Queues;
use App\Enums\Trip\State;
use App\Errors\V1\Delay\AgnetStateNotModified;
use App\Errors\V1\Delay\EstimateNotModified;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;

class CheckTrip extends Job
{
    private BaseTrip $tripService;
    private RepositoriesDelay $delayRepo;
    private BaseEstimate $estimateService;

    public function __construct(private int $orderId, private int $delayId)
    {
    }

    /**
     * In this job, we can send the sync request, because the user is not waiting, and if the job fails, it can be executed again.
     * @return void
     */
    public function handle()
    {
        $this->tripService = app(BaseTrip::class);
        $trip = $this->getTrip();

        $this->delayRepo = app(RepositoriesDelay::class);
        if (!is_null($trip->getCarrierId()) && $trip->getState() != State::DELIVERED) {
            $this->estimateService = app(BaseEstimate::class);
            $this->setNewEstimate();
        } else {
            app('db')->transaction(function() {
                $this->setupForAgents();
            });
        }
    }

    private function getTrip()
    {
        return $this->tripService->getTrip(order_id: $this->orderId);
    }

    private function getEstimate()
    {
        return $this->estimateService->getEstimate();
    }

    private function setNewEstimate(): void
    {
        $estimate = $this->getEstimate();
        $res = $this->delayRepo->setNewEstimate(delayId: $this->delayId, carrier_id: null, estimate: $estimate->getEstimate());
        if (!$res) {
            throw new EstimateNotModified;
        }
    }

    private function setupForAgents()
    {
        $res = $this->delayRepo->agentQueue(delayId: $this->delayId);
        if (!$res) {
            throw new AgnetStateNotModified;
        }

        dispatcher(job: new AgentJob(orderId: $this->orderId))
        ->onQueue(queue: Queues::AGENT_CHECK_QUEUE->value)
        ->setIdentifier(identifier: $this->orderId);
    }
}
