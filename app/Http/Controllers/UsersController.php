<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Rules\alpha_spaces;
use App\Mail\UserPassword;
use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index()
    {
        return view('users', ['data' => Users::all()]);
    }

    public function create(Request $req) {

        $validation = $req->validate([
            'login' => 'required|min:5|string|unique:users,login',
            'email' => 'email|required|min:5|string|unique:users,email',
            'name' => ['required','string',new alpha_spaces,'min:8'],
            'role' => 'required|string'
        ]);

        $random_str = Str::random(12);
        $hashed_random_password = Hash::make($random_str);

        Users::create([
            'login' => $req->input('login'),
            'email' => $req->input('email'),
            'password' => $hashed_random_password,
            'role' => $req->input('role'),
            'name' => $req->input('name'),
        ]);

        Mail::to($req->input('email'))->send(new UserPassword($req->input('name'), $req->input('login'), $random_str));

    }

    public function blocked(Request $req) {
        $user = Users::where('id', $req->input('id'))->first();

        if($user->blocked == 0) {
            $user->blocked = 1;
        } else {
            $user->blocked = 0;
        }

        $user->save();


        return 200;
    }

}
