<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Document;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class FilesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('blocked');
        $this->middleware('last_act');
    } 

    public function download_preview($file_id, $download = true) {

        if (!$file_id) {
            return abort(404);
        }

        if (!Gate::allows('download-documents')) {
            return abort(403, 'Нет прав.');
        }

        $position = Position::find($file_id);

        if (!$position) {
            return abort(404);
        }

        if($download) {
            return response()->download('/var/www/html/example-app/storage/app/' . $position->file, $position->name);
        } else {  
            return response()->file('/var/www/html/example-app/storage/app/' . $position->file);
        }
    }

    public function preview($file_id) {
        return $this->download_preview($file_id, false);
    }

    public function create(Request $req){
        if (!Gate::allows('create-documents') || !Gate::allows('loading-documents')) {
            return abort(403, 'Нет прав.');
        }

        $validation = $req->validate([
            'deadline' => 'sometimes|nullable|date|after_or_equal:' . date('Y-m-d'),  
            'file' => 'required|file|mimes:pdf,jpg,doc,docx,csv,xlsx,png',
            'new_status' => 'sometimes|nullable|string|unique:statuses,name',
            'new_status' => 'required_without_all:document_ready,status'
        ]);

        $path = $req->file->store('documents');

        $position = Position::make([
            'document_id' => $req->id,
            'name' => $req->file->getClientOriginalName(),
            'user_id' => Auth::id(),
            'file' => $path,
            'deadline' => $req->deadline
        ]);

        if(!$req->new_status) {
            $position->status_id = $req->status;
        } else {

            $status = Status::create([
                'name' => $req->new_status,
                'status_id' => $req->status 
            ]);

            $position->status_id = $status->id;
        }

        $position->save();

        if($req->document_ready) { 
            $document = Document::find($req->id);
            $document->completed = 1;
            $document->save();
        }
    }
}
