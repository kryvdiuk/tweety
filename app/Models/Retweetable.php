<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Retweetable
{
    public function retweets(): BelongsToMany
    {
        return $this
            ->belongsToMany(Tweet::class, "retweets", "user_id", "tweet_id")
            ->withTimestamps();
    }

    public function retweet(Tweet $tweet): Model
    {
        if (!auth()->check()) {
            abort(403);
        }

        return $this->retweets()->save($tweet);
    }

    public function toggleRetweet(Tweet $tweet): void
    {
        $this->retweets()->toggle($tweet);
    }
}
