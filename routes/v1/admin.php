<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\V1\Delay\Admin;
use App\Http\Middleware\Transaction;

$router->group(['prefix' => 'delay', 'as' => 'delay'], function() use ($router) {
    $router->post('/assign', [
        'middleware' => [Transaction::class],
        'as' => 'assign',
        'uses' => Admin::class.'@assign'
    ]);
});