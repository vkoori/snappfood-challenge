<?php 

namespace App\Resources\V1\Event\Order;

use App\Constraint\PublisherInterface;

class FindOrder implements PublisherInterface
{
	private int $order_id;

	public function setOrderId(int $order_id): void
	{
		$this->order_id = $order_id;
	}

	public function buildPayload(): array
	{
		return [];
	}

	public function buildHeaders(): array
	{
		return [
			'Accept'			=> 'application/json',
			'Authorization'		=> 'fake jwt',
			'X-Request-ID'		=> $this->order_id
		];
	}
}