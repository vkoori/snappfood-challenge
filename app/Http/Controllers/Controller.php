<?php

namespace App\Http\Controllers;

use App\Utils\Responses\Constraint\JsonResponse;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct(protected JsonResponse $response)
    {}
}
