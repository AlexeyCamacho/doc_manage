<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Rules\alpha_spaces;
use App\Mail\UserPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
    } 

    public function index()
    {
        return view('users', ['data' => User::all()->sortBy('blocked')]);
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

        User::create([
            'login' => $req->login,
            'email' => $req->email,
            'password' => $hashed_random_password,
            'role' => $req->role,
            'name' => $req->name,
        ]);

        Mail::to($req->email)->send(new UserPassword($req->name, $req->login, $random_str));

    }

    public function blocked(Request $req) {
        $user = User::where('id', $req->id)->first();

        if($user->blocked == 0) {
            $user->blocked = 1;
        } else {
            $user->blocked = 0;
        }

        $user->save();


        return 200;
    }

    public function edit(Request $req) {

        $validation = $req->validate([
            'login' => 'required|min:5|string|unique:users,login,'.$req->id,
            'email' => 'email|required|min:5|string|unique:users,email,'.$req->id,
            'name' => ['required','string',new alpha_spaces,'min:8'],
            'role' => 'required|string'
        ]);

        $user = User::where('id', $req->id)->first();

        $user->login = $req->login;
        $user->email = $req->email;
        $user->name = $req->name;
        $user->role = $req->role;

        $user->save();

    }

    public function deleteUser(Request $req) {
       User::destroy($req->id); 
    }

}
