<?php

namespace App\Listeners\Delay;

use App\Apis\Order\BaseOrder;
use App\Enums\Queues;
use App\Errors\V1\Delay\JunkNotModified;
use App\Errors\V1\Delay\TripNotModified;
use App\Events\Delay\DelayReported;
use App\Jobs\CheckTrip;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Queue\InteractsWithQueue;

class CheckOrder implements ShouldQueue
{
    public function __construct(
        private BaseOrder $orderService,
        private RepositoriesDelay $delayRepo
    )
    {
    }

    public function viaQueue()
    {
        return Queues::RECEIVE_ORDER_QUEUE->value;
    }

    public function handle(DelayReported $event)
    {
        $resp = $this->orderService->getOrder(order_id: $event->delay->order_id);
        $expireTime = $resp->getCreatedAt()->addMinutes($resp->getExtendTime());

        app('db')->transaction(function() use ($expireTime, $event) {
            Carbon::now()->gt($expireTime)
                ? $this->junkRequest(orderId: $event->delay->order_id)
                : $this->tripQueue(orderId: $event->delay->order_id);
        });
    }

    private function junkRequest(int $orderId): void
    {
        $res = $this->delayRepo->junkRequest(orderId: $orderId);
        if (!$res) {
            throw new JunkNotModified;
        }
    }

    private function tripQueue(int $orderId): void
    {
        $res = $this->delayRepo->tripQueue(orderId: $orderId);
        if (!$res) {
            throw new TripNotModified;
        }

        dispatcher(job: new CheckTrip(orderId: $orderId))
        ->onQueue(queue: Queues::RECEIVE_TRIP_QUEUE->value)
        ->setIdentifier(identifier: $orderId);
    }
}
