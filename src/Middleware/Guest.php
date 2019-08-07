<?php

namespace FlatFileCms\GUI\Middleware;

use Closure;
use FlatFileCms\GUI\User;
use Illuminate\Support\Facades\Redirect;

class Guest
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
            return $next($request);
        }

        return Redirect::route('dashboard');
    }
}
