<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserFollowTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_follow(): void
    {
        $user = User::factory()->create();
        $follower = User::factory()->create();
        $this->actingAs($user);
        $user->follow($follower);

        $this->assertDatabaseHas('follows', [
            'user_id' => $user->id,
            'followee_id' => $follower->id
        ]);
    }

    /** @test */
    public function user_can_unfollow(): void
    {
        $user = User::factory()->create();
        $follower = User::factory()->create();
        $this->actingAs($user);

        $user->follow($follower);
        $this->assertDatabaseHas('follows', [
            'user_id' => $user->id,
            'followee_id' => $follower->id
        ]);

        $this->assertAuthenticated();
        $user->unfollow($follower);
        $this->assertDatabaseMissing('follows', [
            'user_id' => $user->id,
            'followee_id' => $follower->id
        ]);
    }
}
