<?php 

namespace App\Http\Controllers\V1\Delay;

use App\Http\Controllers\Controller;
use App\Http\Request\V1\Delay\Store;
use Illuminate\Pipeline\Pipeline;
use App\Pipelines\V1\Delay\CheckOpenRequest;
use App\Pipelines\V1\Delay\SaveDelayRequest;

class User extends Controller
{
	public function store(Store $request)
	{
		$request->validated();

		$channel = app(Pipeline::class)
		->send(passable: $request->safeRequest)
		->through(pipes: [
			CheckOpenRequest::class,
			SaveDelayRequest::class,
		])
		->thenReturn();

		return $this->response->created(
			message: __('utils.requestInQueue'),
			data: compact('channel')
		);
	}
}