<?php

namespace App\Http\Middleware;

use Closure;

class Locale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ( $locale = $request->header('Accept-Language') ) {
            app('translator')->setLocale(locale: $locale);
        } else {
            app('translator')->setLocale(locale: env(key: 'LANG', default: 'fa'));
        }

        return $next($request);
    }
}
