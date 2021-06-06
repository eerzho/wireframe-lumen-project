<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class ExampleMiddleware
 * @package App\Http\Middleware
 */
class ExampleMiddleware
{
    /**
     * @param         $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
