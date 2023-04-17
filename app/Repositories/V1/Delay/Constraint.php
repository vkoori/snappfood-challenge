<?php 

namespace App\Repositories\V1\Delay;

use App\Constraint\BaseRepository\BaseRepository;

interface Constraint extends BaseRepository
{
	public function hasOpenRequest(int $orderId): bool;
	public function junkRequest(int $orderId): bool;
	public function tripQueue(int $orderId): bool;
	// public function estimated(int $orderId): bool;
	// public function agentQueue(int $orderId): bool;
}