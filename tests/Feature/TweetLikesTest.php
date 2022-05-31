<?php

namespace Tests\Feature;

use App\Models\Tweet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TweetLikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tweet_can_be_liked(): void
    {
        $tweet = Tweet::factory()->create();
        $user = $tweet->user;
        $this->actingAs($user);
        $tweet->like();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'tweet_id' => $tweet->id,
            'liked' => true,
        ]);
    }

    /** @test */
    public function tweet_can_be_disliked(): void
    {
        $tweet = Tweet::factory()->create();
        $user = $tweet->user;
        $this->actingAs($user);
        $tweet->dislike();

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'tweet_id' => $tweet->id,
            'liked' => false,
        ]);
    }
}
