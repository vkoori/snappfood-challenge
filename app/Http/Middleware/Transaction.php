<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Transaction
{

    public function handle(Request $request, Closure $next)
    {
        app('db')->beginTransaction();
        $response = $next($request);

        if ($response->exception) {
            app('db')->rollBack();
        } else {
            app('db')->commit();
        }

        return $response;
    }
}
