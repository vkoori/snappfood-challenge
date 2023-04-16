<?php 

namespace Tests\Unit\V1\EnumContract;

use App\Enums\SortType;
use Illuminate\Support\Arr;
use PHPUnit\Framework\TestCase;

class EnumTest extends TestCase
{
	public function test_values_method()
	{
		$enum = collect(SortType::cases());

		$this->assertEquals(expected: count(SortType::values()), actual: $enum->count());

		$enum = $enum->toArray();
		$enum = Arr::map($enum, fn($item) => $item->value);

		$this->assertEquals(expected: SortType::values(), actual: $enum);
	}

	public function test_keys_method()
	{
		$enum = collect(SortType::cases());

		$this->assertEquals(expected: count(SortType::keys()), actual: $enum->count());

		$enum = $enum->toArray();
		$enum = Arr::map($enum, fn($item) => $item->name);

		$this->assertEquals(expected: SortType::keys(), actual: $enum);
	}

	public function test_key_values_method()
	{
		$this->assertEquals(
			expected: SortType::keyValues(),
			actual: [SortType::ASC->name => SortType::ASC->value, SortType::DESC->name => SortType::DESC->value]
		);
	}
}