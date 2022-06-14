<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use JetBrains\PhpStorm\ArrayShape;

class TweetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    #[ArrayShape([
        'user_id' => "int",
        'body' => "string",
    ])]
    public function definition(): array
    {
        return [
            "user_id" => User::factory(),
            "body" => $this->faker->sentence
        ];
    }
}
