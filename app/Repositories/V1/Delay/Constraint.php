<?php 

namespace App\Repositories\V1\Delay;

use App\Constraint\BaseRepository\BaseRepository;

interface Constraint extends BaseRepository
{
	public function hasOpenRequest(int $orderId): bool;
	public function junkRequest(int $delayId): bool;
	public function tripQueue(int $delayId): bool;
	public function setNewEstimate(int $delayId, ?int $carrier_id, int $estimate): bool;
	public function agentQueue(int $delayId): bool;
}