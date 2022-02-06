<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'name' => 'ivanphyo',
            'email' => 'ivanphyo2015@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ivan2020'), // ivan2020
            'remember_token' => Str::random(10),
            'role' => '1',
            'is_premium' => '1',

        ]);

        //Genres

        $movies_geners = ['drama','action','commedy','romantic','18+','21+','K-drama','C-drama','K-pop'];

        foreach ($movies_geners as $movie){
            DB::table('genres')->insert([
                'name' => $movie,
                'user_id' => User::all()->random()->id,
            ]);
        };


        \App\Models\User::factory(10)->create();
        \App\Models\Movie::factory(100)->create();

        foreach (Movie::where('is_serie','0')->get() as $movie){
            DB::table('one__movies')->insert([
                'movie_id'=>$movie->id,
                'download_link'=> 'www.youtube.com',
                'rating' => rand(1,5),
                'quality' => "1",
            ]);
        }

//        foreach (Movie::where('is_serie','1')->get() as $movie){
//            for($i=1;$i<5;$i++){
//                    DB::table('series')->insert([
//                        'movie_id'=>$movie->id,
//                        'episode' => $i, //1,5
//                    ]);
//            };
//        }

    }
}
