<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function show(Request $req) {
        return view('site.login');
    }

    public function login(Request $req) {
        $req->validate([
            'username'=>'required',
            'password'=>'required'
        ]);

        if(!loginExists($req->username, $req->password))
            return back()->withErrors("Login doesn't exists");

        $user = userWhoMatchCredentials($req->username, $req->password);

        $req->session()->put('login', $user);

        return redirect()->route('site.home');
    }

    public function logout(Request $req) {
        $req->session()->remove('login');

        return redirect()->route('login.show');
    }
}

function loginExists($username, $password) {

    if(userWhoMatchCredentials($username, $password))
        return true;
    return false;
}

function userWhoMatchCredentials($username, $password) {
    return User::where('username', $username)->where('password', md5($password))->first();
}
