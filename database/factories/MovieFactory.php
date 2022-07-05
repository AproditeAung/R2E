<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'title' => $this->faker->name(),
            'is_serie' => strval(rand(0,1)),
            'director'=> $this->faker->name(),
            'release_year'=> $this->faker->year(),
            'description'=> $this->faker->sentence(50),
            'user_id'=> User::all()->random()->id,

        ];
    }
}
