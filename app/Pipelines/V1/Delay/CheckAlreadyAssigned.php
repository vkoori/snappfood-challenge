<?php

namespace App\Pipelines\V1\Delay;

use App\Errors\V1\Delay\AlreadyAssigned;
use Closure;
use App\Utils\Validations\SafeRequest;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;
use App\Resources\V1\Event\Delay\SendReportToAgent;

class CheckAlreadyAssigned
{
    public function __construct(private RepositoriesDelay $repo)
    {}

    public function handle(SafeRequest $safe, Closure $next)
    {
        if ($delay = $this->repo->getCheckingState(agentId: $safe->request->user_id)) {
            $agentData = new SendReportToAgent;
            $agentData->setReport(model: $delay);
            throw new AlreadyAssigned(data: $agentData->buildPayload());
        }

        return $next($safe);
    }
}
