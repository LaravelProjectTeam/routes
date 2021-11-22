<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // todo: add created at and updated at seeding because as of now
        // laravel doesnt seed them automatically
        DB::table('nodes')->insert([
            'name' => 'Враца',
        ]);
        DB::table('nodes')->insert([
            'name' => 'София',
        ]);
        DB::table('nodes')->insert([
            'name' => 'Пекин',
        ]);
        DB::table('nodes')->insert([
            'name' => 'Плевен',
        ]);
        DB::table('nodes')->insert([
            'name' => 'Чирпан',
        ]);
        DB::table('nodes')->insert([
            'name' => 'Пловдив',
        ]);
    }
}
