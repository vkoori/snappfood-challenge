<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\ExampleController;

$router->get('/', [
    'as' => 'version',
    'uses' => ExampleController::class.'@version'
]);