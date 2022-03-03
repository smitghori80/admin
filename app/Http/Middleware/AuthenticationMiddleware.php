<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthenticationMiddleware
{

    protected $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    public function handle(Request $request, Closure $next)
    {
        // $route = $this->route->getActionName();
        // $name = Str::after($route, '@');
        // $this->authorize(session()->get('user'), $name, session()->get('user'));

        if (Auth::user()!==null) {
            return $next($request);
        } else {
            return redirect(route('loginForm'));
        }
    }
}
