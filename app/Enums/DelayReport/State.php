<?php 

namespace App\Enums\DelayReport;

use App\Utils\EnumContract;

enum State: int
{
	use EnumContract;

	case RECEIVE_ORDER_QUEUE = 0;
	case AGENT_CHECK_QUEUE = 1;
	case CHECKING_AGENT = 2;
	case AGENT_CHECKED = 3;
	case JUNK_REQUEST = 4;
	case ESTIMATED = 5;
	case RECEIVE_TRIP_QUEUE = 6;	
}