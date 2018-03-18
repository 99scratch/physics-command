<?php

namespace App\Http\Middleware;

use Closure;

class CheckKey
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
        $headers = getallheaders();
        if(isset($headers['PHYSICS_HEAD']) && $headers['PHYSICS_HEAD'] == env("PHYSICS_HEAD")) {
            return $next($request);
        }
        else{
            return $next($request);
            //abort(404);
        }
    }
}
