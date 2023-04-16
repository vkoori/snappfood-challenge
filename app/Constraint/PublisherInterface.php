<?php 

namespace App\Constraint;

interface PublisherInterface
{
	/**
	 * Creating a payload that we want to send to another service.
	 */
	public function buildPayload(): array;

	/**
	 * Creating a headers that we want to send to another service.
	 */
	public function buildHeaders(): array;
}