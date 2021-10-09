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

    public function create(Request $req) {
      if (!Gate::allows('management-tags')) {
          return abort(403, 'Нет прав');
      }

      $validation = $req->validate([
          'tag' => 'required|min:3|string|unique:tags,name'
      ]);

      Tag::create([
          'name' => $req->tag
      ]);
    }

    public function edit(Request $req) {
      if (!Gate::allows('management-tags')) {
          return abort(403, 'Нет прав');
      }

      $validation = $req->validate([
          'tag' => 'required|min:3|string|unique:tags,name,'. $req->id
      ]);

      $tag = Tag::find($req->id);

      $tag->update([
          'name' => $req->tag
      ]);

      $tag->save();
    }

    public function delete(Request $req) {
      if (!Gate::allows('management-tags')) {
          return abort(403, 'Нет прав');
      }

      Tag::destroy($req->id);
    }
}
