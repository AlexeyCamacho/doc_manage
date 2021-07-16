<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Gate;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
    } 

    public function index()
    {   
        if (!Gate::allows('views-roles')) {
            return view('PermError');
        }
        return view('role', ['roles' => Role::paginate(10)]);
    }
}
