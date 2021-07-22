<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    } 

    public function index()
    {
        if (!Gate::allows('views-categories')) {
            return view('PermError');
        }

        return view('categories');
    }
}
