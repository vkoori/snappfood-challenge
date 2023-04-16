<?php 

namespace App\Constraint;

interface MetaInterface
{
	public static function object(): array;
	public static function list(): array;
}