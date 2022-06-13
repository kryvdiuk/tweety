<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function has_a_path(): void
    {
        $user = User::factory()->create();
        $this->assertEquals('/profile/' . $user->username, $user->path());
    }
}
