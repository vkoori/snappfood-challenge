<?php 

namespace App\Repositories\V1\Delay;

use App\Repositories\BaseRepository\BaseRepository;
use App\Models\DelayReport;

class Query extends BaseRepository implements Constraint
{
	public function __construct()
	{
		$this->model = new DelayReport;
	}

	public function hasOpenRequest(int $orderId): bool
	{
		return $this->model->query()->Order($orderId)->Open()->count();
	}

	public function junkRequest(int $delayId): bool
	{
		return $this->model->query()->whereId($delayId)->Junk();
	}

	public function tripQueue(int $delayId): bool
	{
		return $this->model->query()->whereId($delayId)->Trip();
	}

	public function setNewEstimate(int $delayId, ?int $carrier_id, int $estimate): bool
	{
		return $this->model->query()->whereId($delayId)->Estimate($carrier_id, $estimate);
	}

	public function agentQueue(int $delayId): bool
	{
		return $this->model->query()->whereId($delayId)->Agent();
	}

}
