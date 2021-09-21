<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Position = new Position();
        $Position->document_id = 1;
        $Position->user_id = 1;
        $Position->name = 'leave.pdf';
        $Position->file = 'shifr';
        $Position->status_id = 1;
        $Position->save();

        $Position = new Position();
        $Position->document_id = 1;
        $Position->user_id = 1;
        $Position->name = 'leave.pdf';
        $Position->file = 'shifr';
        $Position->status_id = 3;
        $Position->save();
    }
}
