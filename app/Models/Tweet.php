<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tweet extends Model
{
    use HasFactory;
    use Likable;

    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function retweets(): BelongsToMany
    {
        return $this
            ->belongsToMany(Tweet::class, "retweets", "tweet_id", "user_id")
            ->withTimestamps();
    }

    /**
     * @param User $user
     * @return bool
     */
    public function isRetweetedBy(User $user): bool
    {
        return $user->retweets()->where("tweet_id", $this->id)->exists();
    }
}
