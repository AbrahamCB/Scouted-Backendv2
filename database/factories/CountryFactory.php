<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class CountryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {   

        $name = $this->faker->name();

        return [
            'country_name' => $name,
            'country_slug' => Str::slug($name, '-'),
            'country_code' => Str::random(4),
        ];
    }
}
