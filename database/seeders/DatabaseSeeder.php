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

        $movies_geners = ['football','comic','commedy','romantic','18+','21+','K-drama','C-drama','K-pop'];

        foreach ($movies_geners as $movie){
            DB::table('genres')->insert([
                'name' => $movie,
                'user_id' => User::all()->random()->id,
                'slug' => Str::slug($movie)
            ]);
        };

    }
}
