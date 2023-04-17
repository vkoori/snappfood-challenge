<?php 

namespace App\Errors\V1\Delay;

use App\Utils\BaseException;

class HasOpenRequest extends BaseException
{
	public function __construct()
	{
		parent::__construct(
			message: __('utils.hasOpenRequest'),
			statusCode: 400,
		);
	}
}