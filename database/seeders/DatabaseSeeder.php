<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            FuelSeeder::class,
            NodeSeeder::class,
            TypeSeeder::class,
        ]);

        // \App\Models\User::factory(10)->create();
    }
}
