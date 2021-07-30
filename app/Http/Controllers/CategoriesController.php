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

    public function index() {
        if (!Gate::allows('views-categories')) {
            return view('PermError');
        }

        if (!session('editMode')) {
            $where[] = ['visible', 1];
        }

        $route = \Route::current();
        $category_id = $route->parameter('id') ?: null;

        $where[] = ['category_id', $category_id];

        $categories = Category::where($where)->with('childrenCategories')->orderBy('name')->get();

        $openCategories_array = session('openCategories');
        $openCategories = collect();
        if ($openCategories_array) {
            foreach($openCategories_array as $key => $value)
            {
                $openCategories->prepend($value);
            }
        }

        return view('categories.categories', ['categories' => $categories, 'openCategories' => $openCategories]);
    }

    public function create(Request $req) {
        if (!Gate::allows('create-categories')) {
            return abort(403, 'Нет прав');
        }

        $user = Category::create([
            'name' => $req->name,
            'category_id' => $req->category_id
        ]);

        if ($user) {
            return redirect()->route('categories'); 
        } else { 
            return abort(500); 
        }
    }

    public function search_key($searchKey, $arr) {
        $result = [];

        foreach ($arr as $category) {

            if (isset($category['id'])) {
                $result[] = $category['id'];
            }

            if (isset($category['categories'])) {
                $result = array_merge($result, self::search_key($searchKey, $category['categories']));
            }
        }

        return $result;
    }

    public function get_children(Request $req) {
        $categories = Category::select('id')->where('category_id', $req->data)->with('childrenCategories')->get();
        $categories = self::search_key('id', $categories);
        return $categories;
    }

    public function edit(Request $req) {
        if (!Gate::allows('edit-categories')) {
            return abort(403, 'Нет прав');
        }

        $validation = $req->validate([
            'title' => 'required|min:4|string'
        ]);

        $req->data = $req->id;
        $childrenCategories = self::get_children($req);
        $childrenCategories[] = $req->id;

        if(in_array($req->category, $childrenCategories)) {
            return abort(500);
        }

        $cat = Category::where('id', $req->id)->first();

        $cat->name = $req->title;

        if ($req->category == 'null') {
            $req->category = NULL;
        }

        $cat->category_id = $req->category;

        $cat->save();
    }

    public function hide(Request $req) {
        if (!Gate::allows('visible-categories')) {
            return abort(403, 'Нет прав');
        }

        $category = Category::find($req->data);
        $category->visible = 0;
        $category->save();


    }

    public function show(Request $req) {
        if (!Gate::allows('visible-categories')) {
            return abort(403, 'Нет прав');
        }

        $category = Category::find($req->data);
        $category->visible = 1;
        $category->save();
    }

    public function delete(Request $req) {
        if (!Gate::allows('delete-categories')) {
            return abort(403, 'Нет прав');
        }

        if ($req->id == 22) {
            return abort(403);
        }

        $cat = Category::where('id', $req->id)->first();

        $categories = $cat->categories;

        foreach ($categories as $category) {
            $category->category_id = $req->category;
            $category->save();
        } 

        $cat->delete();      

    }
}
