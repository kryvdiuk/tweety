<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable, Followable, Retweetable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param string $append
     * @return string
     */
    public function path(string $append = ''): string
    {
        $path = '/profile/' . $this->username;
        return $append === '' ? $path : $path . "/" . $append;
    }

    /**
     * @return mixed
     */
    public function timeline(): mixed
    {
        // TODO add retweets
        $friendIds = $this->followees()->pluck("users.id");

        return Tweet::whereIn("user_id", $friendIds)
            ->orWhere("user_id", $this->id)
            ->with(['likes', 'dislikes'])
            ->latest()
            ->paginate(20);
    }

    /**
     * @return HasMany
     */
    public function tweets(): HasMany
    {
        return $this->hasMany(Tweet::class)->latest();
    }

    /**
     * @return mixed
     */
    public function profileTimeline(): mixed
    {
        $retweetIds = $this->retweets()->pluck("tweet_id")->toArray();
        $retweets = Tweet::whereIn("id", $retweetIds)->where("user_id", "!=", $this->id)->get()->pluck("id")->toArray();
        $tweets = $this->tweets()->pluck("id")->toArray();
        $timelineTweetIds = array_merge($tweets, $retweets);

        return Tweet::whereIn("id", $timelineTweetIds);
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
}
