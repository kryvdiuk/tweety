<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function user_can_edit_profile(): void
    {
        $user = User::factory()->create();

        $oldAttributes = $user->toArray();
        $oldAttributes['password'] = $user->password;
        unset(
            $oldAttributes['id'],
            $oldAttributes['email_verified_at'],
            $oldAttributes['updated_at'],
            $oldAttributes['created_at']);

        $this->actingAs($user);

        $this->get($user->path() . '/edit')->assertStatus(200);


        $newAttributes = [
            "username" => 'newUserName',
            "name" => $this->faker->firstName . ' ' . $this->faker->lastName,
            "email" => $this->faker->email,
            "password" => $password = $this->faker->password(8),
        ];

        $this->patch($user->path(), array_merge($newAttributes, ["password_confirmation" => $password]))
             ->assertRedirect();

        $this->assertDatabaseHas('users', $newAttributes);
        $this->assertDatabaseMissing('users', $oldAttributes);
    }
}
