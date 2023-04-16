<?php 

namespace App\Http;

class Kernel
{
	public static function admin(): array
	{
		$additionalMiddlewars = ['throttle:20,60'];

		return array_merge(self::always(), $additionalMiddlewars);
	}

	public static function user(): array
	{
		$additionalMiddlewars = ['throttle:30,60'];

		return array_merge(self::always(), $additionalMiddlewars);
	}

	private static function always(): array
	{
		return [
			\App\Http\Middleware\Locale::class,
			\App\Http\Middleware\ForceJsonResponse::class
		];
	}
}