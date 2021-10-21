<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Position extends Model
{
    use HasFactory;

    use LogsActivity;

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $fillable = [
        'name', 'user_id', 'file', 'deadline', 'status_id', 'document_id'
    ];

    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function document()
    {
        return $this->belongsTo(Document::class);
    }
}
