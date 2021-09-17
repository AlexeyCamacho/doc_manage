<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Document = new Document();
        $Document->category_id = 1;
        $Document->name = 'Тестовый документ1';
        $Document->description = 'Тестовое описание Тестовое описание Тестовое описание Тестовое описание Тестовое описание';
        //$Document->deadline = '2021-20-09 13:00:00';
        $Document->save();

        $Document = new Document();
        $Document->category_id = 1;
        $Document->name = 'Тестовый документ2';
        $Document->description = 'Тестовое описание Тестовое описание Тестовое описание Тестовое описание Тестовое описание';
        //$Document->deadline = '2021-12-09 13:00:00';
        $Document->save();
    }
}
