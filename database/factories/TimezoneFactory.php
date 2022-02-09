<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimezoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            '_zone_name_' => $this->faker->name(),
            'country_id' => 1,
        ];
    }
}
