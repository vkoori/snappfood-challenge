<?php

namespace App\Utils\Responses\Json;

use App\Utils\Responses\Constraint\JsonResponse as ConstraintJsonResponse;
use App\Utils\Responses\Enum\StatusCode;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class Response implements ConstraintJsonResponse
{
    public function ok(array|string $message = null, array|JsonResource|Collection|Model $data = []): JsonResponse
    {
        return $this->standardResp(statusCode: StatusCode::HTTP_OK, message: $message, data: $data);
    }

    public function created(array|string $message = null, array|JsonResource|Collection|Model $data = []): JsonResponse
    {
        return $this->standardResp(statusCode: StatusCode::HTTP_CREATED, message: $message, data: $data);
    }

    public function badRequest(array|string $message = null, array|string $errors = []): JsonResponse
    {
        return $this->standardResp(statusCode: StatusCode::HTTP_BAD_REQUEST, message: $message, data: $errors);
    }

    public function notFound(array|string $message = null, array|string $errors = []): JsonResponse
    {
        return $this->standardResp(statusCode: StatusCode::HTTP_NOT_FOUND, message: $message, data: $errors);
    }

    public function unauthorized(array|string $message = null, array|string $errors = []): JsonResponse
    {
        return $this->standardResp(statusCode: StatusCode::HTTP_UNAUTHORIZED, message: $message, data: $errors);
    }

    public function resp(int $statusCode, array|string $message = null, array|string|JsonResource|Collection|Model $context = []): JsonResponse
    {
        return $this->standardResp(statusCode: StatusCode::from($statusCode), message: $message, data: $context);
    }

    private function standardResp(
        StatusCode $statusCode=StatusCode::HTTP_OK,
        array|string $message=null,
        array|string|JsonResource|Collection|Model $data=[]
    ): JsonResponse
    {
        $initData = $this->initData($data);
        return new JsonResponse(
            data: [
                'error' => $statusCode->value >= 400 ? true : false,
                'status' => $statusCode->value,
                'message' => $message ?? HttpResponse::$statusTexts[$statusCode->value],
                ... (
                    $statusCode->value >= 400 
                    ? ['errors' => $data] 
                    : ['data' => $initData['res']]
                ),
                ... (
                    ($meta = $initData['with'])
                    ? ['meta' => key($meta) ? $meta : current($meta)]
                    : $meta
                ),
                ... (
                    ($additional = $initData['additional'])
                    ? ['additional' => key($additional) ? $additional : current($additional)]
                    : $additional
                )
            ],
            status: $statusCode->value,
            headers: [
                "Content-Type" => "application/json"
            ]
        );
    }

    private function initData(array|string|JsonResource|Collection|Model|null $data=[]): array
    {
        $with = [];
        $additional = [];
        $res = $data;

        if ($data instanceof JsonResource && $data->resource instanceof LengthAwarePaginator) {
            $res = [
                'paginate' => [
                    'currentPage' => $data->resource->currentPage(),
                    'lastPage' => $data->resource->lastPage(),
                    'total' => $data->resource->total(),
                ],
                'data' => $data
            ];
        }

        if ($data instanceof JsonResource) {
            $with = $data->with(request());
            $additional = $data->additional;
        }

        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $tmp = $this->initData($value);
                if ($tmp['with']) {
                    $with[$key] = $tmp['with'];
                }
                if ($tmp['additional']) {
                    $additional[$key] = $tmp['additional'];
                }
            }
        }

        return [
            'with' => $with,
            'additional' => $additional,
            'res' => $res,
        ];
    }
}
