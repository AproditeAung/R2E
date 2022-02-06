<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class OneMovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
//        foreach (Movie::where('is_serie',0)->get() as $movie){
//            return [
//                'movie_id'=>$movie->id,
//                'download_link'=> $this->faker->url(),
//                'rating' => rand(1,5),
//            ];
//        }

    }
}
