<?php 

namespace App\Apis\Exceptions;

use App\Utils\BaseException;

class ApiException extends BaseException
{
	public function __construct(int $statusCode, array|string $errors)
	{
		if (is_string($errors)) {
			$errors = [$errors];
		}

		parent::__construct(
			message: '',
			statusCode: $statusCode,
			data: $errors
		);
	}
}