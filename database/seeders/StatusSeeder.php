<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Status = new Status();
        $Status->name = 'Документ создан';
        $Status->save();

        $Status = new Status();
        $Status->name = 'Документ готов';
        $Status->save();

        $Status = new Status();
        $Status->name = 'На подписи';
        $Status->save();
    }
}
