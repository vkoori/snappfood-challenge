<?php 

namespace App\Apis\Enums;

use App\Utils\EnumContract;

enum HttpMethod: string
{
	use EnumContract;

	case POST = 'post';
	case GET = 'get';
	case PUT = 'put';
	case PATCH = 'patch';
	case DELETE = 'delete';
}