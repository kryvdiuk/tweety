<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTweetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_create_a_tweet(): void
    {
        $user = User::factory()->hasTweets(1)->create();

        $this->assertDatabaseHas('tweets', ['user_id' => $user->id]);
    }

    /** @test */
    public function user_can_retweet_a_tweet(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->hasTweets(1)->create();
        $this->actingAs($user1);
        $tweet = $user2->tweets()->first();

        $user1->retweet($tweet);

        $this->assertTrue($tweet->isRetweetedBy($user1));

        $this->assertDatabaseHas('retweets', [
            'user_id' => $user1->id,
            'tweet_id' => $tweet->id
        ]);
    }

    /** @test */
    public function user_has_retweets(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->hasTweets(5)->create();
        $this->actingAs($user1);

        foreach($user2->tweets as $tweet) {
            $user1->retweet($tweet);
        }

        $this->assertDatabaseCount('retweets', 5);
    }
}
