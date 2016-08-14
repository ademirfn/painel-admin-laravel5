<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role_id)
    {
        if (!Auth::check()){            
            return redirect()->route('auth.login');
        }
        
        if(Auth::user()->role_id > 3){
            return redirect('/');
        }

        if (Auth::user()->role_id > $role_id){  
            Session::flash('danger', 'Acesso negado! Seu nível de usuário não tem permissão para esta funcionalidade.');
            return redirect()->route('admin.dashboard');
        }    

        return $next($request);
    }
}
