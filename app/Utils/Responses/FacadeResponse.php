<?php

namespace App\Utils\Responses;

use App\Utils\Responses\Json\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse ok(array|string $message = null, array|JsonResource|Collection|Model $data = [])
 * @method static JsonResponse created(array|string $message = null, array|JsonResource|Collection|Model $data = [])
 * @method static JsonResponse badRequest(array|string $message = null, array|string $errors = [])
 * @method static JsonResponse notFound(array|string $message = null, array|string $errors = [])
 * @method static JsonResponse unauthorized(array|string $message = null, array|string $errors = [])
 * @method static JsonResponse resp(int $statusCode, array|string $message = null, array|string|JsonResource|Collection|Model $context = [])
 */
class FacadeResponse extends Facade
{
    protected static function getFacadeAccessor()
    {
        return Response::class;
    }
}