<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;
use Log;
use phpDocumentor\Reflection\DocBlock\Tags\Author;

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
     * @return string
     */
    public function getRetweetTitle(): string
    {
        $result = "";
        $count = 0;
        $numberFollowersByRetweetedTweet = $this->getFollowersByRetweetedTweet()->count();
        $usersForRetweetedTitle = $this->getUsersForRetweetTitle();
        $isUserAuth = $this->isRetweetedBy(auth()->user()) ? 1 : 0;

        foreach ($usersForRetweetedTitle as $userForRetweetedTitle) {
            $result .= $this->getUserLinkForRetweet(
                $userForRetweetedTitle->path(),
                $userForRetweetedTitle->id === auth()->id() ? "You" : $userForRetweetedTitle->name ,
            );
            $count++;

            if ($count === 1) {
                $numberUsersOfRetweetedTweet = $numberFollowersByRetweetedTweet + $isUserAuth;
                if ($usersForRetweetedTitle->count() === 2 && $numberUsersOfRetweetedTweet === 2) {
                    $result .= " and ";
                } else if ($numberUsersOfRetweetedTweet > 2){
                    $result .= ", ";
                }
            }
        }

        $otherRetweetedFollowers = $numberFollowersByRetweetedTweet - $count + $isUserAuth;

        if ($otherRetweetedFollowers > 0) {
            $result .= " and " . $otherRetweetedFollowers ." other follower" . ($otherRetweetedFollowers === 1 ? "" : "s");
        }

        $result .= " retweeted";
        return $result;
    }

    /**
     * @param string $link
     * @param string $name
     * @return string
     */
    private function getUserLinkForRetweet(string $link, string $name): string
    {
        $result = "<a class='font-bold hover:underline' href=" . $link . ">";
        $result .= $name;
        $result .= "</a>";

        return $result;
    }

    /**
     * @return Collection
     */
    private function getUsersForRetweetTitle(): Collection
    {
        $users = [];
        $followersByRetweetedTweet = $this->getFollowersByRetweetedTweet();
        $numberFollowersByRetweetedTweet = $followersByRetweetedTweet->count();

        if ($this->isRetweetedBy(auth()->user())) {
            $users[] = auth()->user();
        }

        for ($i = 0; $i < $numberFollowersByRetweetedTweet; $i++) {
            $users[] = $followersByRetweetedTweet->skip($i)->first();
            if (count($users) === 2) {
                break;
            }
        }

        return collect($users);
    }
}
