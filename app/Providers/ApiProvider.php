<?php

namespace App\Providers;

use App\Apis\Order\BaseOrder;
use App\Apis\Order\V1\MockRequest as OrderRequest;
use Illuminate\Support\ServiceProvider;

class ApiProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(abstract: BaseOrder::class, concrete: OrderRequest::class);
    }
}
