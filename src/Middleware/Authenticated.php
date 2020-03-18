<?php

namespace AloiaCms\GUI\Middleware;

use Closure;
use AloiaCms\GUI\User;
use Illuminate\Support\Facades\Redirect;

class Authenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (is_null(User::fromRequest($request))) {
            User::logout($request);
            return Redirect::guest(route('authenticate.login'));
        }

        return $next($request);
    }
}
