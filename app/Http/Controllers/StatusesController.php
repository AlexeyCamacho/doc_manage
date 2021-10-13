<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class StatusesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    }

    public function index() {
        if (!Gate::allows('management-statuses')) {
            return view('PermError');
        }

        return view('statuses.index', ['statuses' => Status::paginate(25),
        'statusesOption' => Status::whereNull('status_id')->with('childrenStatuses')->orderBy('name')->get()]);
    }

    public function create(Request $req) {
        if (!Gate::allows('management-statuses')) {
            return abort(403, 'Нет прав');
        }

        $validation = $req->validate([
            'new_status' => 'required|min:3|string|unique:statuses,name'
        ]);

        $status = Status::create([
            'name' => $req->new_status,
            'status_id' => $req->status
        ]);
    }

    public function edit(Request $req) {
        if (!Gate::allows('management-statuses')) {
            return abort(403, 'Нет прав');
        }

        $validation = $req->validate([
            'title' => 'required|min:3|string|unique:statuses,name,' . $req->id
        ]);

        $status = Status::find($req->id);

        if ($req->status == 'null') {
            $req->status = NULL;
        }

        $status->update([
            'name' => $req->title,
            'status_id' => $req->status
        ]);

        $status->save();
    }

    public function delete(Request $req) {
      if (!Gate::allows('management-statuses')) {
          return abort(403, 'Нет прав');
      }

      Status::destroy($req->id);
    }
}
