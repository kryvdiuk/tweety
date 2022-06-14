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
    public function run(): void
    {
        $me = User::factory()
            ->hasTweets(2)
            ->create([
                'username' => 'kryvdiuk',
                'name' => 'Mykhailo Kryvdiuk',
                'email' => 'mykhailo.kryvdiuk@gmail.com',
                'password' => Hash::make('123123123'),
            ]);

        $johnDoe = User::factory()
            ->hasTweets(2)
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

        $followers = User::factory()
            ->count(10)
            ->hasTweets(3)
            ->create();

        $users = User::factory()
            ->count(10)
            ->hasTweets(1)
            ->create();

        foreach ($followers as $follower) {
            auth()->login($follower);
            foreach ($me->tweets as $tweet) {
                $follower->retweet($tweet);
            }

            foreach ($users as $user) {
                foreach ($user->tweets as $tweet) {
                    $follower->retweet($tweet);
                }
            }
            auth()->logout();
        }

        foreach($me->tweets as $tweet) {
            foreach($users as $user) {
                auth()->login($user);
                $user->retweet($tweet);
                auth()->logout();
            }
        }

        auth()->login($me, true);
        foreach($followers as $follower) {
            $me->follow($follower);
        }

        foreach($users as $user) {
            foreach($user->tweets as $tweet) {
                $me->retweet($tweet);
            }
        }
    }
}
