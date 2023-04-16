<?php 

namespace App\Constraint;

interface ConsumerInterface
{
	/**
	 * Converts the response received from another service into standard mode
	 * @param  array  $playload
	 * @param  array  $headers
	 * @return static
	 */
	public function parseResponse(array $playload = [], array $headers = []): static;
}