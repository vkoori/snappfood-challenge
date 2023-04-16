<?php 

namespace App\Resources\V1\Event\Delay;

use App\Constraint\PublisherInterface;
use App\Models\DelayReport as ModelsDelayReport;

class SendReportToAgent implements PublisherInterface
{
	private ModelsDelayReport $model;

	public function setReport(ModelsDelayReport $model): void
	{
		$this->model = $model;
	}

	public function buildPayload(): array
	{
		return [
			'vendor_id'			=> $this->model->vendor_id,
			'order_id'			=> $this->model->order_id,
			'user_id'			=> $this->model->user_id,
			'carrier_user_id'	=> $this->model->carrier_user_id,
			'created_at'		=> $this->model->created_at->toIso8601String(),
		];
	}

	public function buildHeaders(): array
	{
		return [
			'Accept'			=> 'application/json',
			'Authorization'		=> 'fake jwt',
			'X-Request-ID'		=> $this->model->id
		];
	}
}