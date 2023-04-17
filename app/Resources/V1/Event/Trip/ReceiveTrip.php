<?php 

namespace App\Resources\V1\Event\Trip;

use App\Constraint\ConsumerInterface;
use App\Enums\Trip\State;

class ReceiveTrip implements ConsumerInterface
{
	private int $order_id;
	private ?int $carrier_user_id;
	private ?State $state;

	public function parseResponse(array $playload = [], array $headers = []): static
	{
		$this
		->setOrderId(order_id: current($headers['X-Request-ID']))
		->setState(state: $playload['state'])
		->setCarrierId(carrier_user_id: $playload['carrier_user_id']);

		return $this;
	}

	public function getOrderId(): int
	{
		return $this->order_id;
	}

	public function getState(): ?State
	{
		return $this->state;
	}

	public function getCarrierId(): int
	{
		return $this->carrier_user_id;
	}

	protected function setOrderId(int $order_id): static
	{
		$this->order_id = $order_id;
		return $this;
	}

	protected function setState(string $state): static
	{
		$this->state = State::tryFrom($state);
		return $this;
	}

	protected function setCarrierId(?int $carrier_user_id): static
	{
		$this->carrier_user_id = $carrier_user_id;
		return $this;
	}
}