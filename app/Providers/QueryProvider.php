<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\V1\Delay\Constraint as DelayConstraint;
use App\Repositories\V1\Delay\Query as DelayQuery;

class QueryProvider extends ServiceProvider
{
    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        // app()->configure('payment');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(abstract: DelayConstraint::class, concrete: DelayQuery::class);
    }
}
