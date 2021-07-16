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
        $Permission->name = 'Просмотр ролей';
        $Permission->slug = 'views-roles';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Создание ролей';
        $Permission->slug = 'create-roles';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Редактирование ролей';
        $Permission->slug = 'edit-roles';
        $Permission->save();

        $Permission = new Permission();
        $Permission->name = 'Удаление ролей';
        $Permission->slug = 'delete-roles';
        $Permission->save();

    }
}
