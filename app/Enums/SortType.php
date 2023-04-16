<?php 

namespace App\Enums;

use App\Utils\EnumContract;

enum SortType: string
{
	use EnumContract;

	case ASC = 'asc';
	case DESC = 'desc';
}