<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Document extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $fillable = [
        'name', 'category_id', 'deadline', 'description', 'completed'
    ];

    public function users()
    {
        return $this->belongsToMany(\App\User::class,'documents_users');
    }

    public function files()
    {
        return $this->hasMany(Position::class, 'document_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'documents_tags');
    }
}
