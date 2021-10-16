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

    public function index() {
        if (!Gate::allows('views-journal')) {
            return view('PermError');
        }

        $categories = Category::whereNull('category_id')->with('childrenCategories')->orderBy('name')->get();
        $statuses = Status::whereNull('status_id')->with('childrenStatuses')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();
        $users = User::all();

        return view('journal.index', [
            'categories' => $categories,
            'statuses' => $statuses,
            'tags' => $tags,
            'users' => $users
        ]);
    }

    public function select(Request $req){
        if (!Gate::allows('views-journal')) {
            return view('inc.PermissionsError');
        }

        $documents = Document::whereNotNull('id');

        // if ($req->filled('statuses')) {
        //     $documents = Document::whereHas('files', function (Builder $query) {
        //         $query->whereIn('status_id', $req->statuses);
        //     })->get();
        // }

        if ($req->filled('categories')) {
            $documents->whereIn('category_id', $req->categories);
        }

        if ($req->filled('users')) {
            $documents->with(['users' => function($query){
                $query->whereIn('id', $req->users);
            }]);
        }
        //
        // if ($req->filled('statuses')) {
        //     $documents->files->whereIn('status_id', $req->statuses);
        // }

        dd($documents->get());
    }
}
