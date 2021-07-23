<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    } 

    public function set(Request $req) {
        if ($req->array) { $req->session()->push($req->key, $req->val); }
        else { $req->session()->put($req->key, $req->val); }
    }

    public function get(Request $req) {

    }

    public function gelete(Request $req) {
        
    }
}
