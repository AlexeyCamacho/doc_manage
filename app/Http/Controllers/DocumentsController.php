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
}
