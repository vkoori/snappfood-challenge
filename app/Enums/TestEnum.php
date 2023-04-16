<?php 

namespace App\Enums;

use App\Utils\EnumContract;

enum TestEnum: int
{
	use EnumContract;

	case TEST = 1;
}