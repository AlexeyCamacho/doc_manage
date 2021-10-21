<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Status extends Model
{
    use HasFactory;
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $fillable = [
        'name', 'status_id', 'visible'
    ];

    public function statuses()
    {
        return $this->hasMany(Status::class);
    }

    public function childrenStatuses()
    {
    return $this->hasMany(Status::class)->with('statuses');
    }

    public function parent()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

}
