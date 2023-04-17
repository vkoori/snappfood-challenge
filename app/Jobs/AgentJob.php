<?php

namespace App\Jobs;

use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;

class AgentJob extends Job
{
    private RepositoriesDelay $delayRepo;

    public function __construct(private int $orderId)
    {
    }

    /**
     * Rest request can be used here as well. Because admin user experience is not important to me :)
     * @return void
     */
    public function handle()
    {
        
    }
}
