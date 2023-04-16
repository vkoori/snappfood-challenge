<?php 

namespace App\Enums\DelayReport;

use App\Utils\EnumContract;

enum State: int
{
	use EnumContract;

	case TEST = 1;
}