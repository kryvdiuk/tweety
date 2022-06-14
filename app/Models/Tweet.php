<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

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

    /**
     * @return Collection
     */
    public function getFollowersByRetweetedTweet(): Collection
    {
        $followers = [];

        foreach (auth()->user()->followees as $follower) {
            if ($this->isRetweetedBy($follower)) {
                $followers[] = $follower;
            }
        }

        return collect($followers);
    }

    public function getRetweetTitle(string $page): string
    {
        $result = '';
        $followersByRetweetedTweet = $this->getFollowersByRetweetedTweet();

        if (
            ($this->isRetweetedBy(auth()->user()) && $this->user_id !== auth()->id() && $page === "profile") ||
            ($page === "home" && $this->isRetweetedBy(auth()->user()) && $this->user_id !== auth()->id())
        ) {
            $result .= "<a class='font-bold hover:underline' href=" . auth()->user()->path() . ">";
            $result .= "You";
            $result .= "</a>";

            if ($followersByRetweetedTweet->count() === 1) {
                $result .= " and ";
                $result .= "<a class='font-bold hover:underline' href=" . $followersByRetweetedTweet->first()->path() . ">";
                $result .= $followersByRetweetedTweet->first()->name;
                $result .= "</a>";
            }
        }

        if ($followersByRetweetedTweet->count()) {
            if ($this->isRetweetedBy(auth()->user())) {
                $result .= ', ';
            }

            $result .= "<a class='font-bold hover:underline' href=" . $followersByRetweetedTweet->first()->path() . ">";
            $result .= $followersByRetweetedTweet->first()->name;
            $result .= "</a>";

            if ($followersByRetweetedTweet->count() > 1 && !$this->isRetweetedBy(auth()->user())) {
                $result .= ', ';
                $result .= "<a class='font-bold hover:underline' href=" . $followersByRetweetedTweet->skip(1)->first()->path() . ">";
                $result .= $followersByRetweetedTweet->skip(1)->first()->name;
                $result .= "</a>";
            }

            $result .= " and others";
        }



        $result .=" Retweeted";
        return $result;
    }
}
