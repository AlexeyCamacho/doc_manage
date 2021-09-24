<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
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
            'documents' => $documents
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

        return view('documents.index', [
            'document' => $document
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
            'status' => 'required_unless:document_ready,on',
            'deadline_position' => 'sometimes|nullable|date|before_or_equal:deadline|after_or_equal:' . date('Y-m-d'),
            'new_status' => 'sometimes|nullable|string|unique:statuses,name',
            'new_status' => 'required_without_all:document_ready,status'
        ]);

        $document = Document::make([
            'name' => $req->title,
            'description' => $req->description,
            'deadline' => $req->deadline,
            'category_id' => $req->id_category 
        ]);

        if($req->document_file && $req->document_ready) {
            $document->completed = 1;
        }

        $document->save();



        $document->users()->attach(Auth::user());
    }
}
