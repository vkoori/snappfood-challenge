<?php 

namespace App\Utils\Validations\Exceptions;

use App\Utils\BaseException;

class ValidationError extends BaseException
{
	public function __construct(array $data)
	{
		parent::__construct(
			message: '',
			statusCode: 422,
			data: $data
		);
	}
}