<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Tag;
use App\Models\Status;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

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

        if (!session('editMode') || !Gate::allows('visible-categories')) {
            $where[] = ['visible', 1];
        }

        $route = \Route::current();
        $category_id = $route->parameter('id') ?: null;

        $where[] = ['category_id', $category_id];

        $categories = Category::where($where)->with('childrenCategories')->orderBy('name')->get();
        $allCategories = Category::whereNull('category_id')->with('childrenCategories')->orderBy('name')->get();
        $statuses = Status::whereNull('status_id')->with('childrenStatuses')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        $openCategories_array = session('openCategories');
        $openCategories = collect();
        if ($openCategories_array) {
            foreach($openCategories_array as $key => $value)
            {
                $openCategories->prepend($value);
            }
        }

        $breadcrumbs = self::get_nav($category_id);

        $breadcrumbs = array_reverse($breadcrumbs);

        $select_category = session('select_category') ?: null;
        if ($select_category) { session()->forget('select_category'); }

        return view('categories.categories', [
            'categories' => $categories,
            'openCategories' => $openCategories,
            'breadcrumbs' => $breadcrumbs,
            'close_child_tabs' => Auth::user()->setting('close_child_tabs'),
            'select_category' => $select_category,
            'allCategories' => $allCategories,
            'statuses' => $statuses,
            'users' => User::where('blocked', '0')->get()->except(Auth::id()),
            'tags' => $tags
        ]);
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

    public function get_nav($id) {
        $result = [];
        $category = Category::find($id);
        if($category) {
            $result[] = collect(['href' => '/doc_manage/categories/' . $category->id, 'name' => $category->name]);
        }

        if($category && $category->category_id) {
            $result = array_merge($result, self::get_nav($category->category_id));
        } else {
            $result[] = collect(['href' => '/doc_manage/categories/', 'name' => 'Главная']);
        }

        return $result;
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

        $documents = $cat->documents;

        foreach ($documents as $document) {
            $document->category_id = $req->doc_category;
            $document->save();
        }

        $cat->delete();

    }
}
