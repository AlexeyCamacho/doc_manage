<?php

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Category = new Category();
        $Category->name = '1 категория';
        $Category->category_id = 3;
        $Category->save();
    }
}
