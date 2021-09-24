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
        $Status->name = 'На подписи у';
        $Status->save();

        $Status = new Status();
        $Status->name = 'выдры';
        $Status->status_id = '4';
        $Status->save();

        $Status = new Status();
        $Status->name = 'Гавилова';
        $Status->status_id = '4';
        $Status->save();

    }
}
