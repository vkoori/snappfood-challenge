<?php 

namespace App\Resources\V1\Event\Delay;

use App\Constraint\PublisherInterface;
use App\Models\DelayReport as ModelsDelayReport;
use App\Enums\DelayReport\State;

class SendExtendTimeToUser implements PublisherInterface
{
	private ModelsDelayReport $model;

	public function setReport(ModelsDelayReport $model): void
	{
		$this->model = $model;
	}

	public function buildPayload(): array
	{
		return [
			'state'				=> State::translate($this->model->state),
			'extend_time'		=> $this->model->extend_time,
		];
	}

	public function buildHeaders(): array
	{
		return [
			'Authorization'		=> 'fake jwt',
			'X-Request-ID'		=> $this->model->order_id
		];
	}
}