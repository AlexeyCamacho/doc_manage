<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

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

}
