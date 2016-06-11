<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth; //tambah
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            //return redirect('/');
            $user = Auth::user();
            if($user->user_group == 'admin') {
                return $next($request);

            } else if($user->user_group == 'staff') {
                return $next($request);

            }else {
                return response('Unauthorized.', 401);
            }
        }
    }
}
