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

	public function junkRequest(int $orderId): bool
	{
		return $this->model->query()->Junk($orderId);
	}

	public function tripQueue(int $orderId): bool
	{
		return $this->model->query()->Trip($orderId);
	}
}
