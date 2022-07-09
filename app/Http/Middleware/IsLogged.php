<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLogged
{
    public function handle(Request $req, Closure $next)
    {
        if($req->session()->exists('login')) // User is already logged
            return $next($req);
        return redirect()->route('login.show');
    }
}
