<?php

namespace App\Pipelines\V1\Delay;

use App\Models\Job;
use Closure;
use App\Utils\Validations\SafeRequest;
use Illuminate\Contracts\Console\Kernel;

class ExtractDelayReport
{
	private Kernel $kernel;

	public function __construct(private Job $queueRepo)
	{
		$this->kernel = app(Kernel::class);
	}

    public function handle(SafeRequest $safe, Closure $next)
    {
        // $delay = $this->kernel->call("queue:work --once --queue=" . Queues::AGENT_CHECK_QUEUE->value);
        $job = $this->queueRepo->getFirstInQueueAgenet();
        $safe->delay = unserialize($job->payload['data']['command'])->handle();

        return $next($safe);
    }
}
