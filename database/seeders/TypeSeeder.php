<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'name' => 'rural',
            'hardship_level' => 4,
            'created_at' => Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'highway',
            'hardship_level' => 2,
            'created_at' => Carbon::now(),
        ]);
        DB::table('types')->insert([
            'name' => 'mountainous',
            'hardship_level' => 6,
            'created_at' => Carbon::now(),
        ]);
    }
}
