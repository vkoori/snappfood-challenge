<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            abstract: \App\Utils\Responses\Constraint\JsonResponse::class,
            concrete: \App\Utils\Responses\Json\Response::class
        );
    }
}
