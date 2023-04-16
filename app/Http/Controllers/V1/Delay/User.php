<?php 

namespace App\Http\Controllers\V1\Delay;

use App\Events\Delay\DelayReported;
use App\Http\Controllers\Controller;

class User extends Controller
{
	public function store()
	{
		event(new DelayReported());

		return $this->response->ok();
	}
}