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
            'name' => 'селски',
            'hardship_level' => 4,
        ]);
        DB::table('types')->insert([
            'name' => 'магистрален',
            'hardship_level' => 2,
        ]);
        DB::table('types')->insert([
            'name' => 'планински',
            'hardship_level' => 6,
        ]);
    }
}
