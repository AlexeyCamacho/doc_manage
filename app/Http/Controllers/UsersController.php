<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Users;
use Illuminate\Support\Facades\Hash;
use App\Rules\nameRule;

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
            'login' => 'required|min:5|string',
            'email' => 'email|required|min:5|string',
            'name' => ['required','string',new nameRule,'min:8'],
            'role' => 'required|string'
        ]);

        Users::create([
            'login' => $req->input('login'),
            'email' => $req->input('email'),
            'password' => Hash::make($req->input('login')),
            'role' => $req->input('role'),
            'name' => $req->input('name'),
        ]);

    }

}
