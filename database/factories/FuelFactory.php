<?php

namespace Database\Factories;

use Faker\Provider\Fakecar;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class FuelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        $faker = (new \Faker\Factory())::create();
//        $faker->addProvider(new Fakecar($faker));

        return [
//            'name' => $this->faker->vehicleFuelType,
            'name' => $this->faker->name,
        ];
    }
}
