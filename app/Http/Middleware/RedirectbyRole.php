<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectbyRole
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
       if (Auth::check())
       {

            if(Auth::user()->hasRole('super admin')||Auth::user()->hasRole('admin malaysia'))
            {
                return $next($request);
            }
       }

        return redirect('programmes');
    }
}
