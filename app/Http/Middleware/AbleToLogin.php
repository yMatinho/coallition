<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AbleToLogin
{
    public function handle(Request $req, Closure $next)
    {
        if(!$req->session()->exists('login')) // User isn't logged yet
            return $next($req);
        return redirect()->route('login.show');
    }
}
