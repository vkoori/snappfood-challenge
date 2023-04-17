<?php 

namespace App\Apis\Order\Trait;

use App\Apis\Exceptions\ApiException;

trait HttpResponse
{
	protected function failed(\Illuminate\Http\Client\Response $response): void
	{
		if ($response->failed()) {
			throw new ApiException(
				statusCode: $response->status(),
				errors: $response->json()['message']??\Illuminate\Http\Response::$statusTexts[$response->status()]
			);
		}
	}
}