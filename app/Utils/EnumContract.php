<?php 

namespace App\Utils;

trait EnumContract
{
	public static function values(): array
	{
		return array_column(self::cases(), 'value');
	}

	public static function keys(): array
	{
		return array_column(self::cases(), 'name');
	}

	public static function keyValues(): array
	{
		$data = [];
		foreach (self::cases() as $case) {
			$data[$case->name] = $case->value;
		}
		return $data;
	}

	public static function casesWithTranslate(): array
	{
		$data = [];
		foreach (self::cases() as $case) {
			array_push($data, [
				'name' => $case->name,
				'value' => $case->value,
				'translate' => self::translate(case: $case)
			]);
		}
		return $data;
	}

	public static function translate(self $case)
	{
		/** @var \Illuminate\Translation\Translator $translator */
		$translator = app('translator');
		$key = 'enum.' . self::getTraitName() . '.' . $case->name;
		
		return $translator->has($key) ? $translator->get($key) : $translator->get('enum.' . $case->name);
	}

	private static function getTraitName()
	{
		$name = get_class();
		return substr($name, strrpos($name, '\\')+1);
	}
}