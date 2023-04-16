<?php 

namespace App\Utils;

use Symfony\Component\HttpKernel\Exception\HttpException;

class BaseException extends HttpException
{
	private array $data=[];

	public function __construct(string $message='', int $statusCode=400, array $data=[])
	{
		$this->data = $data;

		parent::__construct(
			statusCode: $statusCode,
			message: $message,
			previous: null,
			headers: [],
			code: 0
		);
	}

	public function  getData(): array
	{
		return $this->data;
	}
}