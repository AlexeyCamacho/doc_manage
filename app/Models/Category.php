<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'category_id'
    ];
    
    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function categoriesOrderName()
    {
        return $this->hasMany(Category::class)->orderBy('name');
    }

    public function childrenCategories()
{
    return $this->hasMany(Category::class)->with('categories');
}
}
