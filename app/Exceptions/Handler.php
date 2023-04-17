<?php

namespace App\Exceptions;

use App\Errors\V1\Delay\AlreadyAssigned;
use App\Utils\BaseException;
use App\Utils\Responses\Constraint\JsonResponse;
use App\Utils\Validations\Exceptions\ValidationError;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
        ValidationError::class,

    ];

    public function __construct(protected JsonResponse $response)
    {}

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        /** @var \Illuminate\Http\Response|\Illuminate\Http\JsonResponse $error */
        $error = parent::render($request, $exception);

        $error = $this->response->resp(
            statusCode: $error->getStatusCode(),
            message: $this->getMessage($exception),
            context: $this->getContext($exception)
        );

        $error->exception = $exception;

        return $error;
    }

    private function getMessage(Throwable $exception): array|string
    {
        return app(\Illuminate\Pipeline\Pipeline::class)
            ->send(request())
            ->through(
                request()->route() ? [] : \App\Http\Middleware\Locale::class
            )
            ->then(function() use ($exception) {
                return match (true) {
                    $exception instanceof ModelNotFoundException => __('utils.noData'),
                    $exception instanceof MethodNotAllowedHttpException => __('utils.routeNotFound'),
                    $exception instanceof NotFoundHttpException => __('utils.routeNotFound'),
                    $exception instanceof BaseException => empty($exception->getMessage()) ? $exception->getData() : $exception->getMessage(),
                    default => $exception->getMessage(),
                };
            });
    }

    private function getContext(Throwable $exception)
    {
        return match (true) {
            $exception instanceof AlreadyAssigned => $exception->getData(),
            default => !$this->isProduction() && $this->isDebug() ? $this->convertExceptionToArray($exception) : [],
        };
    }

    private function isProduction(): bool
    {
        return !app()->environment(['local', 'development', 'testing', 'staging']);
    }

    private function isDebug(): bool
    {
        return config('app.debug', false);
    }
}
