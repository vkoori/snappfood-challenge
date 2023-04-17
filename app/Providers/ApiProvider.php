<?php

namespace App\Providers;

use App\Apis\Estimate\BaseEstimate;
use App\Apis\Estimate\V1\HttpRequest as EstimateRequest;
use App\Apis\Order\BaseOrder;
use App\Apis\Order\V1\MockRequest as OrderRequest;
use App\Apis\Trip\BaseTrip;
use App\Apis\Trip\V1\MockRequest as TripRequest;
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
        $this->app->bind(abstract: BaseTrip::class, concrete: TripRequest::class);
        $this->app->bind(abstract: BaseEstimate::class, concrete: EstimateRequest::class);
    }
}
