<?php 

namespace App\Apis\Order;

use App\Resources\V1\Event\Order\ReceiveOrder;

interface BaseOrder
{
	public function getOrder(int $order_id): ReceiveOrder;
}