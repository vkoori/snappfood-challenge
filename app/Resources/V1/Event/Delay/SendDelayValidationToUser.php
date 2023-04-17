<?php 

namespace App\Resources\V1\Event\Delay;

use App\Constraint\PublisherInterface;
use App\Models\DelayReport as ModelsDelayReport;

class SendDelayValidationToUser implements PublisherInterface
{
	private ModelsDelayReport $model;

	public function setReport(ModelsDelayReport $model): void
	{
		$this->model = $model;
	}

	public function buildPayload(): array
	{
		return [
			'state'				=> $this->model->state->name,
		];
	}

	public function buildHeaders(): array
	{
		return [
			'Accept'			=> 'application/json',
			'Authorization'		=> 'fake jwt',
			'X-Request-ID'		=> $this->model->order_id
		];
	}
}