<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ZoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->address(),
            'name_mm' => $this->faker->unique()->address(),
            'city_id' => $this->faker->randomElement(\App\Models\City::pluck('id')->toArray())
        ];
    }
}
