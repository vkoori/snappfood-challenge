<?php 

namespace App\Resources\V1\Event\Estimate;

use App\Constraint\ConsumerInterface;

class ReceiveEstimate implements ConsumerInterface
{
	private int $estimate;

	public function parseResponse(array $playload = [], array $headers = []): static
	{
		$this->setEstimate(estimate: $playload['data']['eta']);

		return $this;
	}

	public function getEstimate(): int
	{
		return $this->estimate;
	}

	protected function setEstimate(int $estimate): static
	{
		$this->estimate = $estimate;
		return $this;
	}
}