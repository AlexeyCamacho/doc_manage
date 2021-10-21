<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.index');
    }

    public function settings()
    {
        $settings = config('default_user_settings.keys');
        return view('home.settings', ['all_settings' => $settings]);
    }

    public function settings_change(Request $req){
        $user = User::where('id', $req->user_id)->first();
        if($user->setting($req->setting)) {
            $value = 0;
        } else {
            $value = 1;
        }
        $user->settings([$req->setting => $value]);
    }

    public function settings_get(Request $req){
        $close_child_tabs = Auth::user()->setting($req->setting);
        return $close_child_tabs;
    }
}
