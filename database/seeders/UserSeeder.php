<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $me = User::factory()
            ->hasTweets(10)
            ->create([
                'username' => 'kryvdiuk',
                'name' => 'Mykhailo Kryvdiuk',
                'email' => 'mykhailo.kryvdiuk@gmail.com',
                'password' => Hash::make('123123123'),
            ]);

        $johnDoe = User::factory()
            ->hasTweets(5)
            ->create([
                'username' => 'j.doe',
                'name' => 'John Doe',
                'email' => 'john.doe@gmail.com',
                'password' => Hash::make('123123123'),
            ]);
        auth()->login($johnDoe);
        foreach($me->tweets as $tweet) {
            $johnDoe->retweet($tweet);
            $tweet->like();
        }
        auth()->logout();

        $users = User::factory()
            ->count(10)
            ->hasTweets(5)
            ->create();

        auth()->login($me, true);

        foreach($users as $user) {
            $me->follow($user);
        }

        User::factory()
            ->count(10)
            ->hasTweets(10)
            ->create();
    }
}
