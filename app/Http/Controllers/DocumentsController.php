<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
            'new_status' => 'sometimes|nullable|string|unique:statuses,name',
            'status' => 'required|alpha_dash',
            'deadline_position' => 'sometimes|nullable|date|before_or_equal:deadline|after_or_equal:' . date('Y-m-d'),
            'new_status' => 'required_if:status,null',
        ]);

        $document = Document::make([
            'name' => $req->title,
            'description' => $req->description,
            'deadline' => $req->deadline,
        ]); 
    }
}
