<?php 

namespace App\Resources\V1\Event\Delay;

use App\Constraint\ConsumerInterface;

class ReceiveReportFromAgent implements ConsumerInterface
{
	private int $correlation_id;
	private int $extend_time;
	private int $agent_user_id;
	private int $order_id;

	public function parseResponse(array $playload = [], array $headers = []): static
	{
		$this
		->setDelayReportId(correlation_id: $headers['correlation_id'])
		->setExtendTime(extend_time: $playload['extend_time'])
		->setAgentUserId(agent_user_id: $playload['agent_user_id'])
		->setOrderId(order_id: $playload['order_id']);

		return $this;
	}

	public function getDelayReportId(): int
	{
		return $this->correlation_id;
	}

	public function getExtendTime(): int
	{
		return $this->extend_time;
	}

	public function getAgentUserId(): int
	{
		return $this->agent_user_id;
	}

	public function getOrderId(): int
	{
		return $this->order_id;
	}

	protected function setDelayReportId(int $correlation_id): static
	{
		$this->correlation_id = $correlation_id;
		return $this;
	}

	protected function setExtendTime(int $extend_time): static
	{
		$this->extend_time = $extend_time;
		return $this;
	}

	protected function setAgentUserId(int $agent_user_id): static
	{
		$this->agent_user_id = $agent_user_id;
		return $this;
	}

	protected function setOrderId(int $order_id): static
	{
		$this->order_id = $order_id;
		return $this;
	}
}