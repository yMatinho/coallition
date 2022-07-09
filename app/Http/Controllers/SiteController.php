<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function home(Request $req) {

        return view('site.home', [

        ]);

    }

}
