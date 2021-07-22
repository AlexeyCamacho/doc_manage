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
        $Category->name = 'Степик';
        $Category->category_id = 1;
        $Category->save();

        $Category = new Category();
        $Category->name = 'Лекториум';
        $Category->category_id = 1;
        $Category->save();

        $Category = new Category();
        $Category->name = 'Открытое образование';
        $Category->category_id = 1;
        $Category->save();

        $Category = new Category();
        $Category->name = 'График отпусков';
        $Category->category_id = 2;
        $Category->save();

        $Category = new Category();
        $Category->name = 'Приказы';
        $Category->category_id = 2;
        $Category->save();
    }
}
