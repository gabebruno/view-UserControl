<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AdminCheck
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

        if ($user->permission == 2) {
            return $next($request);
        }

        return redirect()->route('home')->withErrors("Only admin can access this feature!");;
    }
}
