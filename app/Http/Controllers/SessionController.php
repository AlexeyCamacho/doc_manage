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
        if ($req->array) { 
            $array = $req->session()->get($req->key);

            if (!$array || !in_array($req->val, $array)) { $req->session()->push($req->key, $req->val); }
        }
        else { $req->session()->put($req->key, $req->val); }
    }

    public function get(Request $req) {

    }

    public function delete(Request $req) {
        if ($req->array) {
            $array = $req->session()->get($req->key);

            if(($key = array_search($req->val, $array)) !== false){
                unset($array[$key]); 
                $req->session()->forget($req->key);
                $req->session()->put($req->key, $array);
            }
        }
        else { $req->session()->put($req->key, $req->val); }

    }   

    public function reset(Request $req) {
        
        $req->session()->forget($req->key);

        return $req->session()->get($req->key);

    } 
}
