<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder/home/k/
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
    }
}
