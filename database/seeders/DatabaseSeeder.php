<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Movie;
use App\Models\ReaderWallet;
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
            'name' => 'KNDF0001',
            'email' => 'kndf0001@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ivan2020'), // ivan2020
            'remember_token' => Str::random(10),
            'role' => '2',
            'reference_id' => uniqid()

        ]);

        $wallet = new ReaderWallet();
        $wallet->user_id  = 1;
        $wallet->wallet_no = uniqid();
        $wallet->amount = 0;
        $wallet->save();


        $blog_geners = ['football','comic','commedy','romantic','18+','21+','K-drama','C-drama','K-pop'];

        foreach ($blog_geners as $blog){
            DB::table('categories')->insert([
                'name' => $blog,
                'user_id' => User::all()->random()->id,
                'slug' => Str::slug($blog)
            ]);
        };

        Blog::factory()->count(50)->create();
    }
}
