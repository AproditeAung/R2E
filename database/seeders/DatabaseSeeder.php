<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Movie;
use App\Models\ReaderWallet;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
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
            'name' => '001',
            'email' => 'ivan@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ivan2020'), // ivan2020
            'remember_token' => Str::random(10),
            'role' => '2',
        ]);

        DB::table('users')->insert([
            'name' => '003',
            'email' => 'ivanphyo@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('ivan2020'), // ivan2020
            'remember_token' => Str::random(10),
            'role' => '1',
        ]);

        $userDetail = new UserDetail();
        $userDetail->user_id = 1;
        $userDetail->reference_id = uniqid();
        $userDetail->save();

        $userDetail = new UserDetail();
        $userDetail->user_id = 2;
        $userDetail->reference_id = uniqid();
        $userDetail->save();

        $wallet = new ReaderWallet();
        $wallet->user_id  = 1;
        $wallet->wallet_no = uniqid();
        $wallet->amount = 0;
        $wallet->save();

        $wallet = new ReaderWallet();
        $wallet->user_id  = 2;
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
