<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Spatie\Activitylog\Models\Activity;

class LogsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    }

    public function index(Request $req) {
        if (!Gate::allows('views-logs')) {
            return view('PermError');
        }

        $logs = Activity::orderBy('id', 'desc');

        if ($req->filled('users')) {
            $logs->whereIn('causer_id', $req->users);
        }

        if ($req->filled('actions')) {
            $logs->whereIn('description', $req->actions);
        }

        if ($req->filled('object')) {
            $logs->whereIn('subject_type', $req->object);
        }

        if($req->date_from != null) {
          $logs->where('created_at', '>' ,$req->date_from);
        }

        if($req->date_before != null) {
          $logs->where('created_at', '<' ,$req->date_before);
        }

        $users = User::all();
        $logs = $logs->paginate(20)->withQueryString();
        $actions = Activity::select('description')->distinct('description')->get();
        $objects = Activity::select('subject_type')->distinct('subject_type')->get();

        return view('logs.index', compact('users', 'logs', 'actions', 'objects', 'req'));
    }

}
