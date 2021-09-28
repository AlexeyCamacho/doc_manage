<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

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
}
