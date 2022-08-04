<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Psy\Util\Str;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pinBlog = 0;
        $title = $this->faker->sentence(1);
        return [
            'title' => $title,
            'body' => $this->faker->paragraph(random_int(10,40)),
            'sample' => $this->faker->paragraph(random_int(3,5)),
            'slug' => \Illuminate\Support\Str::slug($title),
            'category_id' => Category::all()->random()->id,
            'user_id' => User::all()->random()->id,
            'countUser' => 0,
        ];
    }
}
