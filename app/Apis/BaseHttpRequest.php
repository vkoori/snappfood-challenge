<?php

namespace App\Apis;

use App\Apis\Trait\HttpResponse;
use App\Constraint\PublisherInterface;
use App\Apis\Enums\HttpMethod;
use Illuminate\Http\Client\Factory as Http;

class BaseHttpRequest
{
	use HttpResponse;

	protected string $baseUrl;
	protected PublisherInterface $sendRepo;
	public ?MockHttp $mock = null;
	private Http $http;

	public function send(HttpMethod $method, string $url)
	{
		$this->http = app(Http::class);

		if ($this->mock && $this->mock->has(method: $method, path: $url)) {
			$this->mockRequest(method: $method, url: $url);
		}

		$response = $this->normalRequest(method: $method, url: $url);

		$this->failed($response);

		return $response;
	}

	private function mockRequest(HttpMethod $method, string $url)
	{
		$mock = $this->mock->get(method: $method, path: $url);

		return $this->http->fake([
			$this->baseUrl . $url => $this->http->response(
				body: $mock['body'],
				status: $mock['status'],
				headers: $mock['headers']
			)
		]);
	}

	private function normalRequest(HttpMethod $method, string $url): \Illuminate\Http\Client\Response
	{
		return call_user_func(
			[$this->http, 'withHeaders'],
			$this->sendRepo->buildHeaders()
		)->{$method->value}($this->baseUrl . $url, $this->sendRepo->buildPayload());
	}
}
