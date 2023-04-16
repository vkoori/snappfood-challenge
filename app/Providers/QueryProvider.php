<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        // $this->app->bind(abstract: InvoiceQueriesContract::class, concrete: InvoiceQueries::class);
    }
}
