<?php 

namespace App\Http\Controllers\V1\Delay;

use App\Http\Controllers\Controller;
use App\Http\Request\V1\Delay\Assign;
use App\Pipelines\V1\Delay\AssignToAgent;
use App\Pipelines\V1\Delay\CheckAlreadyAssigned;
use App\Pipelines\V1\Delay\ExtractDelayReport;
use App\Repositories\V1\Delay\Constraint as RepositoriesDelay;
use App\Resources\V1\Http\Delay\ListView;
use Illuminate\Pipeline\Pipeline;
use App\Resources\V1\Event\Delay\SendReportToAgent;

class Admin extends Controller
{
	public function assign(Assign $request)
	{
		$request->validated();

		$safeRequest = app(Pipeline::class)
		->send(passable: $request->safeRequest)
		->through(pipes: [
			CheckAlreadyAssigned::class,
			ExtractDelayReport::class,
			AssignToAgent::class,
		])
		->thenReturn();

		$agentResponse = new SendReportToAgent;
		$agentResponse->setReport($safeRequest->delay);

		return $this->response->ok(
			message: __('utils.success'),
			data: $agentResponse->buildPayload()
		);
	}

	public function report(RepositoriesDelay $delayRepo)
	{
		return $this->response->ok(
			message: __('utils.success'),
			data: new ListView($delayRepo->getMostDelayedPastWeek())
		);
	}
}