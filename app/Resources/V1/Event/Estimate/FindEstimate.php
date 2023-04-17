<?php 

namespace App\Resources\V1\Event\Estimate;

use App\Constraint\PublisherInterface;

class FindEstimate implements PublisherInterface
{
	public function buildPayload(): array
	{
		return [];
	}

	public function buildHeaders(): array
	{
		return [];
	}
}