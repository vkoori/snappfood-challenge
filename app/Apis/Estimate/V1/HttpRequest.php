<?php 

namespace App\Apis\Estimate\V1;

use App\Apis\Enums\HttpMethod;
use App\Apis\BaseHttpRequest;
use App\Apis\Estimate\BaseEstimate;
use App\Resources\V1\Event\Estimate\FindEstimate;
use App\Resources\V1\Event\Estimate\ReceiveEstimate;

class HttpRequest extends BaseHttpRequest implements BaseEstimate
{
	public function __construct()
	{
		$this->baseUrl = rtrim(env('ESTIMATE_HTTP_BASE'), '/');
	}

	public function getEstimate(): ReceiveEstimate
	{
		$this->sendRepo = new FindEstimate;

		$resp = $this->send(method: HttpMethod::GET, url: '/122c2796-5df4-461c-ab75-87c1192b17f7');
		$standardResp = new ReceiveEstimate;
		$standardResp->parseResponse(playload: $resp->json(), headers: $resp->headers());

		return $standardResp;
	}
}