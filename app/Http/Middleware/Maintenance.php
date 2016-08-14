<?php

namespace App\Http\Middleware;

use Closure;
use Config;

class Maintenance {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Config::get('maintenance.running')) {

            $except = Config::get('maintenance.except');
            if (!in_array($request->ip(), $except)){
                abort(503, "System in maintenance");
            }           
            
        }

        return $next($request);
    }

}
