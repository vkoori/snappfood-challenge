<?php 

namespace App\Apis\Trip\V1;

use App\Apis\Enums\HttpMethod;
use App\Apis\BaseHttpRequest;
use App\Apis\Trip\BaseTrip;
use App\Resources\V1\Event\Trip\FindTrip;
use App\Resources\V1\Event\Trip\ReceiveTrip;

class HttpRequest extends BaseHttpRequest implements BaseTrip
{
	public function __construct()
	{
		$this->baseUrl = rtrim(env('Trip_HTTP_BASE'), '/');
	}

	public function getTrip(int $order_id): ReceiveTrip
	{
		$this->sendRepo = new FindTrip;
		$this->sendRepo->setOrderId(order_id: $order_id);

		$resp = $this->send(method: HttpMethod::GET, url: '/');
		$standardResp = new ReceiveTrip;
		$standardResp->parseResponse(playload: $resp->json(), headers: $resp->headers());

		return $standardResp;
	}
}