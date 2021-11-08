<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FuelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fuels')->insert([
            'name' => "бензин",
        ]);
        DB::table('fuels')->insert([
            'name' => "дизел",
        ]);
        DB::table('fuels')->insert([
            'name' => "биодизел",
        ]);
        DB::table('fuels')->insert([
            'name' => "пропан",
        ]);
        DB::table('fuels')->insert([
            'name' => "електрически",
        ]);
    }
}
