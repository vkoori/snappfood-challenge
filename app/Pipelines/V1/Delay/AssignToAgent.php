<?php

namespace App\Pipelines\V1\Delay;

use App\Errors\V1\Delay\AssignFailed;
use Closure;
use App\Utils\Validations\SafeRequest;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;

class AssignToAgent
{
    public function __construct(private RepositoriesDelay $repo)
    {}

    public function handle(SafeRequest $safe, Closure $next)
    {
        $res = $this->repo->assignToAgent(delayId: $safe->delay->id, agentId: $safe->request->user_id);
        if (!$res) {
        	throw new AssignFailed;
        }

        return $next($safe);
    }
}
