<?php

namespace App\Listeners\Delay;

use App\Events\Delay\DelayReported;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CheckTrips implements ShouldQueue
{
    public function __construct()
    {
        //
    }

    public function handle(DelayReported $event)
    {

    }
}
