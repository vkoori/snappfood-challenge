<?php 

namespace App\Utils\Responses\Constraint;

use Illuminate\Http\JsonResponse as HttpJsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface JsonResponse
{
	public function ok(array|string $message = null, array|JsonResource|Collection|Model $data = []): HttpJsonResponse;

	public function created(array|string $message = null, array|JsonResource|Collection|Model $data = []): HttpJsonResponse;

	public function badRequest(array|string $message = null, array|string $errors = []): HttpJsonResponse;

	public function notFound(array|string $message = null, array|string $errors = []): HttpJsonResponse;

	public function unauthorized(array|string $message = null, array|string $errors = []): HttpJsonResponse;

	public function resp(int $statusCode, array|string $message = null, array|string|JsonResource|Collection|Model $context = []): HttpJsonResponse;
}