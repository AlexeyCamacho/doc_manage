<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $Permission = new Permission();
        $Permission->name = 'Скачивание документов';
        $Permission->slug = 'download-documents';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Загрузка документов';
        $Permission->slug = 'loading-documents';
        $Permission->save();


    }
}
