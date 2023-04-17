<?php 

namespace App\Resources\V1\Event\Order;

use App\Constraint\ConsumerInterface;
use Illuminate\Support\Carbon;

class ReceiveOrder implements ConsumerInterface
{
	private int $order_id;
	private int $delivery_time;
	private Carbon $created_at;

	public function parseResponse(array $playload = [], array $headers = []): static
	{
		$this
		->setOrderId(order_id: current($headers['X-Request-ID']))
		->setExtendTime(delivery_time: $playload['delivery_time'])
		->setCreatedAt(created_at: $playload['created_at']);

		return $this;
	}

	public function getOrderId(): int
	{
		return $this->order_id;
	}

	public function getExtendTime(): int
	{
		return $this->delivery_time;
	}

	public function getCreatedAt(): Carbon
	{
		return $this->created_at;
	}

	protected function setOrderId(int $order_id): static
	{
		$this->order_id = $order_id;
		return $this;
	}

	protected function setExtendTime(int $delivery_time): static
	{
		$this->delivery_time = $delivery_time;
		return $this;
	}

	protected function setCreatedAt(string $created_at): static
	{
		$this->created_at = Carbon::parse($created_at)->setTimezone(env("APP_TIMEZONE"));
		return $this;
	}
}