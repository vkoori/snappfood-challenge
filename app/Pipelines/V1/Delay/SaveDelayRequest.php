<?php

namespace App\Pipelines\V1\Delay;

use App\Enums\DelayReport\State;
use App\Events\Delay\DelayReported;
use Closure;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;
use App\Utils\Validations\SafeRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class SaveDelayRequest
{
	public function __construct(private RepositoriesDelay $repo)
	{}

	public function handle(SafeRequest $safe, Closure $next)
	{
		$model = $this->saveDate(safe: $safe);
		$this->fireEvent(safe: $safe, model: $model);

		return $next($safe->channel);
	}

	private function saveDate(SafeRequest $safe): Model
	{
		$payload = $safe->request->all();
		$payload['state'] = State::RECEIVE_ORDER_QUEUE;
		return $this->repo->create(payload: $payload);
	}

	private function fireEvent(SafeRequest $safe, Model $model): void
	{
		$uuid = Str::uuid()->toString();
		$safe->channel = $uuid;

		event(new DelayReported(delay: $model, uuid: $uuid));
	}
}
