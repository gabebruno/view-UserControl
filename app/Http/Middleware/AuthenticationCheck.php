<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AuthenticationCheck
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $user = Session::get('user');

        if (isset($user->permission))
        {
            return $next($request);
        }

        return redirect()->route('login')->withErrors("You don't have access, please login!");
    }
}
