<?php

namespace App\Http\Middleware;

use App\Components\Constants\ResultCode;
use App\Traits\Response\Response;
use Closure;
use Illuminate\Contracts\Auth\Factory as Auth;

/**
 * Class Authenticate
 * @package App\Http\Middleware
 */
class Authenticate
{
    use Response;

    protected $auth;

    /**
     * Create a new middleware instance.
     *
     * @param \Illuminate\Contracts\Auth\Factory $auth
     *
     * @return void
     */
    public function __construct(Auth $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     * @param string|null              $guard
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($this->auth->guard($guard)->guest()) {
            return self::response([], ResultCode::UNAUTHORIZED);
        }

        return $next($request);
    }
}
