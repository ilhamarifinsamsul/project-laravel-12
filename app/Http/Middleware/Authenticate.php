<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role = null): Response
    {
        // check if user is logged in
        if (session()->get('isLogged') == null && session()->get('userId') == null) {
            return redirect()->route('auth.login')->with('error', 'You must be logged in to access this page');
        }

        // check if user has the required role
        if ($role != null) {
            $role = explode("|", $role);
            foreach($role as $r){
                if(session()->get('userRole') == $r){
                    return $next($request);
                }
                return redirect()->route('auth.login')->with('error', 'You do not have permission to access this page');
            }
            return $next($request);
        }
    }
}
