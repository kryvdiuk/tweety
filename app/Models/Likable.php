<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

trait Likable
{
    public function scopeWithLikes(): void
    {
        Tweet::withCount(['likes', 'dislikes']);
    }

    public function dislike(): void
    {
        if ($this->isLikedBy(auth()->user())) {
            Like::where("user_id", "=", auth()->id())
                ->where("tweet_id", "=", $this->id)
                ->update(["liked" => false]);
        } else {
            Like::create([
                "user_id" => auth()->id(),
                "tweet_id" => $this->id,
                "liked" => false
            ]);
        }
    }

    public function isLikedBy(User $user, $liked = true): bool
    {
        return (bool)$user->likes
            ->where("tweet_id", $this->id)
            ->where("liked", $liked)
            ->count();
    }

    public function like(): void
    {
        if ($this->isDislikedBy(auth()->user())) {
            Like::where("user_id", "=", auth()->id())
                ->where("tweet_id", "=", $this->id)
                ->update(["liked" => true]);
        } else {
            Like::create([
                "user_id" => auth()->id(),
                "tweet_id" => $this->id,
                "liked" => true
            ]);
        }
    }

    public function isDislikedBy(User $user): bool
    {
        return $this->isLikedBy($user, false);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class)->where('liked', true);
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(Like::class)->where('liked', false);
    }

    public function unlike(): void
    {
        Like::where("tweet_id", "=", $this->id)->where("user_id", "=", auth()->id())->delete();
    }

}
