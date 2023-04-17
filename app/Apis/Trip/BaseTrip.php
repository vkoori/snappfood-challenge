<?php 

namespace App\Apis\Trip;

use App\Resources\V1\Event\Trip\ReceiveTrip;

interface BaseTrip
{
	public function getTrip(int $order_id): ReceiveTrip;
}