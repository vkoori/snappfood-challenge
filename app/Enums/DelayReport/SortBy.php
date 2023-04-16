<?php 

namespace App\Enums\DelayReport;

use App\Utils\EnumContract;

enum SortBy: string
{
	use EnumContract;

	case TEST = '1';
}