<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FolloweesTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     * @return void
     */
    public function user_can_see_followees(): void
    {
        $numberFollowees = 10;
        $user = User::factory()->hasFollowees($numberFollowees)->create();
        $this->be($user);
        $this->assertEquals($numberFollowees, $user->followees()->count());
        $response = $this->get($user->path() . '/followees')->assertOk();

        foreach($user->followees as $followee) {
            $response->assertSee($followee->username);
        }
    }
}
