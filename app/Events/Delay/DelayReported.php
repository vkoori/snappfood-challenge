<?php

namespace App\Events\Delay;

use App\Events\Event;
use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DelayReported extends Event implements ShouldBroadcast
{
	public function __construct(public array $x = ['a' => 'b'])
	{

	}

	public function broadcastOn()
	{
		return ['user'];
	}

	public function broadcastWith()
	{
		return ['user' => 'test'];
	}
}
