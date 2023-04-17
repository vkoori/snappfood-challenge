<?php 

namespace App\Apis\Order\V1;

use App\Apis\Enums\HttpMethod;
use App\Apis\Order\BaseOrder;
use App\Apis\Order\MockHttp;
use App\Resources\V1\Event\Order\ReceiveOrder;
use Illuminate\Support\Carbon;

class MockRequest implements BaseOrder
{
	public function __construct(private HttpRequest $httpRepo)
	{
	}

	public function getOrder(int $order_id): ReceiveOrder
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

		return $this->httpRepo->getOrder(order_id: $order_id);
	}

	private function orderWhoseDeliveryTimeHasNotArrived(int $orderId)
	{
		return [
			'headers' => [
				'X-Request-ID' => $orderId,
			],
			'body' => [
				'delivery_time' => 15,
				'created_at' => Carbon::now()->toIso8601String(),
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
				'delivery_time' => 15,
				'created_at' => Carbon::now()->subMinutes(20)->toIso8601String(),
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
				'delivery_time' => 15,
				'created_at' => Carbon::now()->subMinutes(20)->toIso8601String(),
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
				'delivery_time' => 15,
				'created_at' => Carbon::now()->subMinutes(20)->toIso8601String(),
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