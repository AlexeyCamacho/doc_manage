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
        $this->middleware('last_act');
    } 

    public function index()
    {   
        if (!Gate::allows('views-permissions')) {
            return view('PermError');
        }
        return view('permissions', ['permissions' => Permission::paginate(10)]);
    }
}
