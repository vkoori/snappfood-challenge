<?php 

namespace App\Errors\V1\Delay;

use App\Utils\BaseException;

class AlreadyAssigned extends BaseException
{
	public function __construct(array $data)
	{
		parent::__construct(
			message: __('utils.alreadyAssignedRequest'),
			statusCode: 403,
			data: $data
		);
	}
}