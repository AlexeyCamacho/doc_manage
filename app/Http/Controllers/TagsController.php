<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class TagsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    }

    public function index() {
        if (!Gate::allows('management-tags')) {
            return view('PermError');
        }
        return view('tags.index', ['tags' => Tag::paginate(25)]);
    }
}
