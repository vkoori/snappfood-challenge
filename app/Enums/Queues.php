<?php 

namespace App\Enums;

use App\Utils\EnumContract;

enum Queues: string
{
	use EnumContract;

	case RECEIVE_ORDER_QUEUE = 'ORDER_QUEUE';
	case AGENT_CHECK_QUEUE = 'AGENT_QUEUE';
	case RECEIVE_TRIP_QUEUE = 'TRIP_QUEUE';
}