<?php

namespace App\Apis;

use App\Apis\Enums\HttpMethod;

class MockHttp
{
	private array $fakes = [];

	public function fake(
		HttpMethod $method,
		string $path,
		array|string|null $responseBody = null,
		array $responseHeader = [],
		int $status = 200
	): void
	{
		$this->fakes[$this->key(method: $method, path: $path)] = [
			'body'		=> $responseBody,
			'status'	=> $status,
			'headers'	=> $responseHeader
		];
	}

	public function has(HttpMethod $method, string $path): bool
	{
		return isset($this->fakes[$this->key(method: $method, path: $path)]);
	}

	public function get(HttpMethod $method, string $path): array
	{
		return $this->fakes[$this->key(method: $method, path: $path)];
	}

	public function forget(HttpMethod $method, string $path): void
	{
		unset($this->fakes[$this->key(method: $method, path: $path)]);
	}

    public function flush(): void
    {
    	$this->fakes = [];
    }

	private function key(HttpMethod $method, string $path): string
	{
		return $path . '@' . $method->value;
	}
}
