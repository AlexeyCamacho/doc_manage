<?php

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
        $Permission->name = 'Просмотр категорий';
        $Permission->slug = 'views-categories';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Создание категорий';
        $Permission->slug = 'create-categories';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Изменение категорий';
        $Permission->slug = 'edit-categories';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Удаление категорий';
        $Permission->slug = 'delete-categories';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Скрытие/показ категорий';
        $Permission->slug = 'visible-categories';
        $Permission->save();
    }
}
