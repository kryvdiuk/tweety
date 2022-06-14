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

    /**
     * @var array
     */
    protected $guarded = [];

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsToMany
     */
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

    /**
     * @param string $page
     * @return string
     */
    public function getRetweetTitle(string $page): string
    {
        $result = "";
        $count = 0;
        $followersByRetweetedTweet = $this->getFollowersByRetweetedTweet();

        if (
            ($page === "profile" && $this->isRetweetedBy(auth()->user()) && $this->user_id !== auth()->id()) ||
            ($page === "home" && $this->isRetweetedBy(auth()->user()) && $this->user_id !== auth()->id())
        ) {
            $result = $this->getUserLinkForRetweet(
                $result,
                auth()->user()->path(),
                "You",
                $count
            );

            if ($followersByRetweetedTweet->count() === 1) {
                $result .= " and ";
                $result = $this->getUserLinkForRetweet(
                    $result,
                    $followersByRetweetedTweet->first()->path(),
                    $followersByRetweetedTweet->first()->name,
                    $count
                );
            }
        }

        if ($followersByRetweetedTweet->count()) {
            if ($this->isRetweetedBy(auth()->user()) && $this->user_id !== auth()->id()) {
                $result .= ', ';
            }

            $result = $this->getUserLinkForRetweet(
                $result,
                $followersByRetweetedTweet->first()->path(),
                $followersByRetweetedTweet->first()->name,
                $count
            );
            if (
                ($followersByRetweetedTweet->count() > 1 && !$this->isRetweetedBy(auth()->user())) ||
                ($followersByRetweetedTweet->count() === 1 && $this->isRetweetedBy(auth()->user())) ||
                ($followersByRetweetedTweet->count() > 1 && $this->user_id === auth()->id())
            ) {
                $result .= ', ';
                $result = $this->getUserLinkForRetweet(
                    $result,
                    $followersByRetweetedTweet->skip(1)->first()->path(),
                    $followersByRetweetedTweet->skip(1)->first()->name,
                    $count
                );
            }

            $result .= " and ". $this->retweets->count() - $count ." others";
        }

        $result .= " retweeted";
        return $result;
    }

    /**
     * @param string $result
     * @param string $link
     * @param string $name
     * @param int $count
     * @return string
     */
    private function getUserLinkForRetweet(string $result, string $link, string $name, int &$count): string
    {
        $result .= "<a class='font-bold hover:underline' href=" . $link . ">";
        $result .= $name;
        $result .= "</a>";

        $count++;
        return $result;
    }
}
