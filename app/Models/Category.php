<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Category extends Model
{
    use LogsActivity;

    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    protected $fillable = [
        'name', 'category_id'
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categoriesOrderNameAll()
    {
        return $this->hasMany(Category::class)->orderBy('name');
    }

    public function categoriesOrderNameVisible()
    {
        return $this->hasMany(Category::class)->where('visible', 1)->orderBy('name');
    }

    public function childrenCategories()
    {
    return $this->hasMany(Category::class)->with('categories');
    }

    public function documents() {
        return $this->hasMany(Document::class, 'category_id');
    }
}
