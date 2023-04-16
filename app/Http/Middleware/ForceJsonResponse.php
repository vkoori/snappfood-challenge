<?php

namespace App\Http\Middleware;

use Closure;
use Laravel\Lumen\Http\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * ForceJsonResponse. Enforces Json on every response
 */
class ForceJsonResponse
{
    /**
     * The Response Factory our app uses
     *
     * @var ResponseFactory
     */
    protected $factory;

    /**
     * JsonMiddleware constructor.
     *
     * @param ResponseFactory $factory
     */
    public function __construct(ResponseFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Get the response
        $response = $next($request);

        // Do we need to convert the string to an json?
        if ( 
            str_contains(
                haystack: $request->headers->get('Accept'), 
                needle: 'application/json'
            ) 
        ) {
            // If the response is not strictly a JsonResponse, we make it
            if (!$response instanceof JsonResponse) {
                $response = $this->factory->json(
                    $response->content(),
                    $response->status(),
                    $response->headers->all()
                );
            }
        }

        return $response;
    }
}
