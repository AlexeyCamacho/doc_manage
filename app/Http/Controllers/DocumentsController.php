<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Tag;
use App\Models\Status;
use App\Models\Document;
use App\Models\Category;
use App\Models\Position;
use Illuminate\Http\Request;
use App\Jobs\ProcessDeleteFiles;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class DocumentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    }

    public function select(Request $req) {

        if (!Gate::allows('views-all-documents')) {
            return view('inc.PermissionsError');
        }

        $documents = Document::where('category_id', $req->id_category)->orderBy('completed', 'asc')->latest()->get();

        return view('documents.documents',[
            'documents' => $documents,
        ]);
    }

    public function index() {
        if (!Gate::allows('views-documents')) {
            return view('PermError');
        }

        $route = \Route::current();
        $documents_id = $route->parameter('id') ?: null;

        if ($documents_id == null) { return redirect('categories');}

        $document = Document::find($documents_id);
        $allCategories = Category::whereNull('category_id')->with('childrenCategories')->orderBy('name')->get();
        $statuses = Status::whereNull('status_id')->with('childrenStatuses')->orderBy('name')->get();
        $tags = Tag::orderBy('name')->get();

        $filesTypes = $collection = collect([]);
        foreach ($document->files as $file) {
            $filesTypes->push(pathinfo($file->file)['extension']);
        }



        return view('documents.index', [
            'document' => $document,
            'allCategories' => $allCategories,
            'users' => User::all()->except(Auth::id()),
            'statuses' => $statuses,
            'tags' => $tags,
            'filesTypes' => $filesTypes->unique()
        ]);
    }

    public function create(Request $req) {
        if (!Gate::allows('create-documents')) {
            return abort(403, 'Нет прав.');
        }

        if ($req->document_file && !Gate::allows('loading-documents')) {
            return abort(403, 'Нет прав загружать файл.');
        }


        $validation = $req->validate([
            'title' => 'required|string',
            'description' => 'sometimes|nullable|min:5|string',
            'deadline' => 'sometimes|nullable|date|after_or_equal:' . date('Y-m-d'),
            'document_file' => 'sometimes|nullable|file|mimes:pdf,jpg,doc,docx,csv,xlsx,png',
            'deadline_position' => 'sometimes|nullable|date|before_or_equal:deadline|after_or_equal:' . date('Y-m-d'),
            'new_status' => 'sometimes|nullable|string|unique:statuses,name',
            'new_status' => 'required_without_all:document_ready,status',
            'tags' => 'sometimes|nullable|array'
        ]);

        $document = Document::create([
            'name' => $req->title,
            'description' => $req->description,
            'deadline' => $req->deadline,
            'category_id' => $req->id_category
        ]);

        $document->tags()->attach($req->tags);

        if($req->document_file) {

            $path = $req->document_file->store('documents');

            $position = Position::make([
                'name' => $req->document_file->getClientOriginalName(),
                'user_id' => Auth::id(),
                'file' => $path
            ]);

            if($req->document_ready) {
                $document->completed = 1;
                $document->save();
                $position->deadline = $req->deadline;
                $position->status_id = config('db_const.doc_ready');
            } else {
                $position->deadline = $req->deadline_position;

                if(!$req->new_status) {
                    $position->status_id = $req->status;
                } else {

                    $status = Status::create([
                        'name' => $req->new_status,
                        'status_id' => $req->status
                    ]);

                    $position->status_id = $status->id;
                }
            }

            $position->document_id = $document->id;
            $position->save();
        }

        $document->users()->attach(Auth::user());
    }

    public function edit(Request $req) {
        if (!Gate::allows('edit-documents')) {
            return abort(403, 'Нет прав.');
        }

        $document = Document::find($req->id);

        if($document->completed) {
            return abort(403, 'Нет прав.');
        }



        $validation = $req->validate([
            'title' => 'required|string',
            'description' => 'sometimes|nullable|min:5|string',
            'tags' => 'sometimes|nullable|array'
        ]);

        if($req->deadline != $document->deadline) {
            $validation = $req->validate([
            'deadline' => 'date|after_or_equal:' . max(date('Y-m-d'), $document->files->max('deadline')),
            ]);

        }

        $document->update([
            'name' => $req->title,
            'description' => $req->description,
            'deadline' => $req->deadline,
            'category_id' => $req->category
        ]);

        $document->tags()->detach();
        $document->tags()->attach($req->tags);

        if(Auth::user()->setting('switch_category')) {
            $req->session()->put('select_category', $req->category);
        }

    }

    public function active(Request $req) {
        if (!Gate::allows('actions-completed-documents')) {
            return abort(403, 'Нет прав');
        }

        $document = Document::find($req->data);
        $document->completed = 0;
        $document->save();
    }

    public function complete(Request $req) {
        if (!Gate::allows('edit-documents')) {
            return abort(403, 'Нет прав');
        }

        $document = Document::find($req->data);
        $document->completed = 1;
        $document->save();
    }

    public function responsible_edit(Request $req) {
        $document = Document::find($req->id);
        if ((!Gate::allows('edit-users-documents') && !$document->users->contains(Auth::id())) || $document->completed) {
            return abort(403, 'Нет прав');
        }

        if(!$document->users->contains(Auth::id())) {
            $validation = $req->validate([
                'users' => 'required|array|min:1'
            ]);
        }

        $document->users()->detach();
        $document->users()->attach($req->users);

        if($document->users->contains(Auth::id())) {
            $document->users()->attach(Auth::id());
        }

    }

    public function delete(Request $req) {
        if (!Gate::allows('delete-documents')) {
            return abort(403, 'Нет прав');
        }

        $document = Document::find($req->id);


        foreach ($document->files as $file) {
            dispatch(new ProcessDeleteFiles($file->file));
        }

        Document::destroy($req->id);

    }

}
