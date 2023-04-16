<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\V1\Delay\User as Delay;

$router->group(['prefix' => 'delay', 'as' => 'delay'], function() use ($router) {
	$router->post('/', [
		// 'middleware' => [Transaction::class],
		'as' => 'store',
		'uses' => Delay::class.'@store'
	]);
});