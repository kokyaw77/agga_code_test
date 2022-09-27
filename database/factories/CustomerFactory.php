<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone_no' => $this->faker->unique()->phoneNumber(),
            'city_id' => $this->faker->randomElement(\App\Models\City::pluck('id')->toArray()),
            'zone_id' => $this->faker->randomElement(\App\Models\Zone::pluck('id')->toArray()),
            'address' => $this->faker->address()
        ];
    }
}
