<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class RoadTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('road_types')->insert([
            'name' => 'магистрален',
            'hardship_level' => 20,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('road_types')->insert([
            'name' => 'селски',
            'hardship_level' => 40,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('road_types')->insert([
            'name' => 'планински',
            'hardship_level' => 60,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
