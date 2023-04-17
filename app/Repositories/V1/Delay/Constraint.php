<?php 

namespace App\Repositories\V1\Delay;

use App\Constraint\BaseRepository\BaseRepository;
use App\Models\DelayReport;
use Illuminate\Pagination\LengthAwarePaginator;

interface Constraint extends BaseRepository
{
	public function hasOpenRequest(int $orderId): bool;
	public function junkRequest(int $delayId): bool;
	public function tripQueue(int $delayId): bool;
	public function setNewEstimate(int $delayId, ?int $carrier_id, int $estimate): bool;
	public function agentQueue(int $delayId): bool;
	public function hasCheckingState(int $agentId): bool;
	public function getCheckingState(int $agentId): ?DelayReport;
	public function assignToAgent(int $delayId, int $agentId): bool;
	public function getMostDelayedPastWeek(): LengthAwarePaginator;
}