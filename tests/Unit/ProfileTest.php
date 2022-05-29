<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_has_a_path()
    {
        $user = User::factory()->create();
        $this->assertEquals('/profile/' . $user->username, $user->path());
    }
}
