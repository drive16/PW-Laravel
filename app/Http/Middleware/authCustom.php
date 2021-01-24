<?php

namespace NetworkConfigurator\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;

class authCustom
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
        session_start();
        
        if(!isset($_SESSION['logged'])) {
            return Redirect::to(route('user.login'));
        }
        
        return $next($request);
    }
}
