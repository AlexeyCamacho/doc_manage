<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use App\Rules\alpha_spaces;
use App\Mail\UserPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    } 

    public function index()
    {
        if (!Gate::allows('views-users')) {
            return view('PermError');
        }

        return view('users', ['users' => User::orderBy('blocked')->paginate(10), 
            'roles' => Role::orderBy('id', 'desc')->get()]);
    }

    public function create(Request $req) {

        if (!Gate::allows('create-users')) {
            return abort(403, 'Нет прав');
        }

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
            'name' => $req->name,
        ]);

        $role = Role::where('slug', $req->role)->first();
        $user = User::where('login', $req->login)->first();

        $user->roles()->attach($role);

        Mail::to($req->email)->send(new UserPassword($req->name, $req->login, $random_str));

    }

    public function blocked(Request $req) {

        if (!Gate::allows('blocked-users')) {
            return abort(403, 'Нет прав');
        }

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

        if (!Gate::allows('edit-users')) {
            return abort(403, 'Нет прав');
        }

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

        $user->save();

        $user->roles()->detach();

        $role = Role::where('slug', $req->role)->first();
        $user->roles()->attach($role);

    }

    public function delete(Request $req) {

        if (!Gate::allows('delete-users')) {
            return abort(403, 'Нет прав');
        }

       User::destroy($req->id); 
    }

}
