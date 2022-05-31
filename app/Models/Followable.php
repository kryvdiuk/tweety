<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait Followable
{
    public function followees(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class, "follows", "user_id", "followee_id")
            ->withTimestamps();
    }

    public function follow(User $user): Model
    {
        if (!auth()->check()) {
            abort(403);
        }

        return $this->followees()->save($user);
    }

    public function unfollow(User $user): int
    {
        if (!auth()->check()) {
            abort(403);
        }

        return $this->followees()->detach($user);
    }

    public function following(User $user): bool
    {
        return $this->followees()->where("followee_id", $user->id)->exists();
    }

    public function toggleFollowee(User $user): void
    {
        $this->followees()->toggle($user);
    }
}
