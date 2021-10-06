<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use HasFactory;

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
