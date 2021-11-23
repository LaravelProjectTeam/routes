<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'kris',
            'email' => 'admin@kristiyan.tech',
            'admin' => true,
            'password' => bcrypt('KRIS_ADMIN_PASS'),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'radi',
            'email' => 'admin@radi.bg',
            'admin' => true,
            'password' => bcrypt('radi12345678'),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'alex',
            'email' => 'admin@alex.bg',
            'admin' => true,
            'password' => bcrypt('alex12345678'),
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
