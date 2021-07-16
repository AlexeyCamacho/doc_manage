<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;

class PermissionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
    } 

    public function index()
    {   
        return view('permissions', ['data' => Permission::all()]);
    }
}
