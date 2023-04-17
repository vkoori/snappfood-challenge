<?php 

namespace App\Http\Controllers\V1\Delay;

use App\Http\Controllers\Controller;
use App\Http\Request\V1\Delay\Assign;
use App\Pipelines\V1\Delay\CheckAlreadyAssigned;
use App\Pipelines\V1\Delay\ExtractDelayReport;
use Illuminate\Pipeline\Pipeline;

class Admin extends Controller
{
	public function assign(Assign $request)
	{
		$request->validated();

		$delay = app(Pipeline::class)
		->send(passable: $request->safeRequest)
		->through(pipes: [
			CheckAlreadyAssigned::class,
			ExtractDelayReport::class,
			AssignToAgent::class,
		])
		->thenReturn();

		return $this->response->ok(
			message: __('utils.success'),
			data: compact('delay')
		);
	}
}