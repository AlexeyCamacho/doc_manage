<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Tag;
use App\Models\Status;
use App\Models\Document;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class JournalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    }

    public function index(Request $req) {
        if (!Gate::allows('views-journal')) {
            return view('PermError');
        }

        $documents = Document::whereNotNull('id');


        if ($req->filled('statuses')) {
            $AllStatuses = [];
            foreach ($req->statuses as $status) {
                $AllStatuses[] = $status;
                $statuses = Status::select('id')->where('status_id', $status)->with('childrenStatuses')->get();
                $AllStatuses = array_merge($AllStatuses, $this->search_children_for_key('id', $statuses, 'statuses'));
            }

            $documents->whereHas('files', function($query) use ($AllStatuses){
                return $query->whereIn('status_id', $AllStatuses);
            });

        }

        if ($req->filled('categories')) {
            $AllCategories = [];
            foreach ($req->categories as $category) {
                $AllCategories[] = $category;
                $categories = Category::select('id')->where('category_id', $category)->with('childrenCategories')->get();
                $AllCategories = array_merge($AllCategories, $this->search_children_for_key('id', $categories, 'categories'));
            }
            $documents->whereIn('category_id', $AllCategories);
        }

        if ($req->filled('users')) {
            $documents->whereHas('users', function($query) use($req){
                return $query->whereIn('id', $req->users);
            });
        }

        if ($req->filled('tags')) {
            $documents->whereHas('tags', function($query) use($req){
                return $query->whereIn('id', $req->tags);
            });
        }

        if($req->date_from != null) {
          $documents->where('created_at', '>' ,$req->date_from);
        }

        if($req->date_before != null) {
          $documents->where('created_at', '<' ,$req->date_before);
        }

        if($req->deadline_from != null) {
          $documents->where('deadline', '>' ,$req->deadline_from);
        }

        if($req->deadline_before != null) {
          $documents->where('deadline', '<' ,$req->deadline_before);
        }

        if ($req->filled('only_not_completed')) {
            $documents->where('completed', '0');
        }

        $categories = Category::whereNull('category_id')->with('childrenCategories')->orderBy('name')->get();
        $statuses = Status::whereNull('status_id')->with('childrenStatuses')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $users = User::all();

        $documents = $documents->paginate(10)->withQueryString();;

        return view('journal.index', compact('categories', 'statuses', 'tags', 'users', 'documents', 'req'));
    }

}
