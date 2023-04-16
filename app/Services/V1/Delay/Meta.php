<?php 

namespace App\Services\V1\Delay;

use App\Constraint\MetaInterface;
use App\Enums\DelayReport\SortBy;
use App\Enums\DelayReport\State;
use App\Enums\SortType;

class Meta implements MetaInterface
{
	public static function object(): array
	{
		return [
			'state' => State::casesWithTranslate()
		];
	}

	public static function list(): array
	{
		return [
			'state' => State::casesWithTranslate(),
			'sort_by' => SortBy::values(),
			'sort_type' => SortType::values(),
		];
	}
}