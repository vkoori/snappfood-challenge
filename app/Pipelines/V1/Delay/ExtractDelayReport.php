<?php

namespace App\Pipelines\V1\Delay;

use App\Enums\Queues;
use Closure;
use App\Utils\Validations\SafeRequest;
use Illuminate\Contracts\Console\Kernel;

class ExtractDelayReport
{
	private Kernel $kernel;

	public function __construct()
	{
		$this->kernel = app(Kernel::class);
	}

    public function handle(SafeRequest $safe, Closure $next)
    {
        $delay = $this->kernel->call("queue:work --once --queue=" . Queues::AGENT_CHECK_QUEUE->value);
        $safe->delay = $delay;

        return $next($safe);
    }
}
