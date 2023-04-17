<?php

namespace App\Pipelines\V1\Delay;

use App\Errors\V1\Delay\HasOpenRequest;
use Closure;
use App\Utils\Validations\SafeRequest;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;

class CheckOpenRequest
{
    public function __construct(private RepositoriesDelay $repo)
    {}

    public function handle(SafeRequest $safe, Closure $next)
    {
        if ($this->repo->hasOpenRequest(orderId: $safe->request->order_id)) {
            throw new HasOpenRequest;
        }

        return $next($safe);
    }
}
