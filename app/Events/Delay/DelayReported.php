<?php

namespace App\Events\Delay;

use App\Events\Event;
use App\Models\DelayReport as ModelsDelayReport;
use App\Resources\V1\Event\Delay\SendDelayValidationToUser;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class DelayReported extends Event implements ShouldBroadcastNow
{
	public function __construct(public ModelsDelayReport $delay, private string $uuid)
	{
	}

	public function broadcastOn()
	{
		return [$this->uuid];
	}

	public function broadcastWith()
	{
		$userResponse = new SendDelayValidationToUser;
		$userResponse->setReport(model: $this->delay->refresh());

		return [
			'payload' => $userResponse->buildPayload(),
			'headers' => $userResponse->buildHeaders(),
		];
	}
}
