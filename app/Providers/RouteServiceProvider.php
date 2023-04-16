<?php

namespace App\Providers;

use App\Http\Kernel;
use Illuminate\Support\ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->router->group([
            'prefix' => 'api/v1/admin',
            'middleware' => Kernel::admin(),
            'as' => 'api.v1.admin'
        ], function ($router) {
            require base_path() . '/routes/v1/admin.php';
        });

        $this->app->router->group([
            'prefix' => 'api/v1/user',
            'middleware' => Kernel::user(),
            'as' => 'api.v1.user'
        ], function ($router) {
            require base_path() . '/routes/v1/user.php';
        });
    }
}
