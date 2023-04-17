<?php 

namespace App\Errors\V1\Delay;

use App\Utils\BaseException;

class AgnetStateNotModified extends BaseException
{
	public function __construct()
	{
		parent::__construct(
			message: __('utils.noUpdated'),
			statusCode: 500,
		);
	}
}