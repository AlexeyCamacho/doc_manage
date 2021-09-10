<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Role = new Role();
        $Role->name = 'Администратор';
        $Role->slug = 'admin';
        $Role->save();

        $Role = new Role();
        $Role->name = 'Директор';
        $Role->slug = 'director';
        $Role->save();

        $Role = new Role();
        $Role->name = 'Специалист по УМР';
        $Role->slug = 'specialist';
        $Role->save();

        $Role = new Role();
        $Role->name = 'Лаборант';
        $Role->slug = 'technician';
        $Role->save();
    }
}
