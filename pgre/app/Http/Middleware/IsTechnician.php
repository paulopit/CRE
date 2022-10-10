<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class IsTechnician
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
        if (Auth::user() &&  Auth::user()->user_type_id == 2) {
            return $next($request);
        }


        return redirect('/')->with('error','You dont have Technician access');
    }
}
