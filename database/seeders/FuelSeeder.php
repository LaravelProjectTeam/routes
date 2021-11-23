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
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('fuels')->insert([
            'name' => "дизел",
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('fuels')->insert([
            'name' => "биодизел",
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('fuels')->insert([
            'name' => "пропан",
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('fuels')->insert([
            'name' => "електрически",
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
