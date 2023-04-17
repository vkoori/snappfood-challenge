<?php 

namespace App\Enums\Trip;

use App\Utils\EnumContract;

enum State: string
{
	use EnumContract;

	case ASSIGNED = 'ASSIGNED';
	case VENDOR_AT = 'VENDOR_AT';
	case PICKED = 'PICKED';
	case DELIVERED = 'DELIVERED';
}