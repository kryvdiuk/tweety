<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FollowersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @return void
     */
    public function user_can_see_followers(): void
    {
        $numberFollowers = 10;
        $user = User::factory()->hasFollowers($numberFollowers)->create();
        $this->be($user);
        $this->assertEquals($numberFollowers, $user->followers()->count());
        $response = $this->get($user->path() . '/followers')->assertOk();

        foreach($user->followers as $follower) {
            $response->assertSee($follower->username);
        }
    }


}
