<?php 

namespace App\Apis\Trip\V1;

use App\Apis\Enums\HttpMethod;
use App\Apis\Trip\BaseTrip;
use App\Apis\MockHttp;
use App\Resources\V1\Event\Trip\ReceiveTrip;

class MockRequest implements BaseTrip
{
	public function __construct(private HttpRequest $httpRepo)
	{
	}

	public function getTrip(int $order_id): ReceiveTrip
	{
		$resp = match ($order_id) {
			1 => $this->orderWhoseDeliveryTimeHasNotArrived(orderId: $order_id),
			2 => $this->orderWhoseDeliveryTimeHasArrivedAndHasTripButNotDelivered(orderId: $order_id),
			3 => $this->orderWhoseDeliveryTimeHasArrivedAndHasTripButDelivered(orderId: $order_id),
			4 => $this->orderWhoseDeliveryTimeHasArrivedAndHasNotTrip(orderId: $order_id),
			default => $this->timeout(orderId: $order_id),
		};

		$this->httpRepo->mock = new MockHttp;
		$this->httpRepo->mock->fake(
			method: HttpMethod::GET,
			path: '/',
			responseBody: $resp['body'],
			responseHeader: $resp['headers'],
			status: $resp['status']
		);

		return $this->httpRepo->getTrip(order_id: $order_id);
	}

	private function orderWhoseDeliveryTimeHasNotArrived(int $orderId)
	{
		return [
			'headers' => [
				'X-Request-ID' => $orderId,
			],
			'body' => [
				'carrier_user_id' => null,
				'state' => ''
			],
			'status' => 200
		];
	}

	private function orderWhoseDeliveryTimeHasArrivedAndHasTripButNotDelivered(int $orderId)
	{
		return [
			'headers' => [
				'X-Request-ID' => $orderId,
			],
			'body' => [
				'carrier_user_id' => 1,
				'state' => 'PICKED'
			],
			'status' => 200
		];
	}

	private function orderWhoseDeliveryTimeHasArrivedAndHasTripButDelivered(int $orderId)
	{
		return [
			'headers' => [
				'X-Request-ID' => $orderId,
			],
			'body' => [
				'carrier_user_id' => 1,
				'state' => 'DELIVERED'
			],
			'status' => 200
		];
	}

	private function orderWhoseDeliveryTimeHasArrivedAndHasNotTrip(int $orderId)
	{
		return [
			'headers' => [
				'X-Request-ID' => $orderId,
			],
			'body' => [
				'carrier_user_id' => null,
				'state' => ''
			],
			'status' => 200
		];
	}

	private function timeout(int $orderId)
	{
		return [
			'headers' => [],
			'body' => [],
			'status' => 504
		];
	}
}