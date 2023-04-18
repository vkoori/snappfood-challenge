<?php

namespace App\Jobs;

use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;

class AgentJob extends Job
{
    private RepositoriesDelay $delayRepo;

    public function __construct(private int $delayId)
    {
    }

    public function handle()
    {
        $this->delayRepo = app(RepositoriesDelay::class);
        $delay = $this->getDelay();

        request()->attributes->add(['delay' => $delay]);

        return $delay;
    }

    private function getDelay()
    {
        return $this->delayRepo->findByIdOrFail(modelId: $this->delayId);
    }
}
