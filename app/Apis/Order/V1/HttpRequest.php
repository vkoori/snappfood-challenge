<?php 

namespace App\Apis\Order\V1;

use App\Apis\Enums\HttpMethod;
use App\Apis\BaseHttpRequest;
use App\Apis\Order\BaseOrder;
use App\Resources\V1\Event\Order\FindOrder;
use App\Resources\V1\Event\Order\ReceiveOrder;

class HttpRequest extends BaseHttpRequest implements BaseOrder
{
	public function __construct()
	{
		$this->baseUrl = rtrim(env('ORDER_HTTP_BASE'), '/');
	}

	public function getOrder(int $order_id): ReceiveOrder
	{
		$this->sendRepo = new FindOrder;
		$this->sendRepo->setOrderId(order_id: $order_id);

		$resp = $this->send(method: HttpMethod::GET, url: '/');
		$standardResp = new ReceiveOrder;
		$standardResp->parseResponse(playload: $resp->json(), headers: $resp->headers());

		return $standardResp;
	}
}