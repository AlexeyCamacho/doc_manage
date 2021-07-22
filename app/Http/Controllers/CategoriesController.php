<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $categories = Category::whereNull('category_id')->with('childrenCategories')->get();

        return view('categories.categories', compact('categories'));
    }
}
