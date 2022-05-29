<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Like
 *
 * @property int $id
 * @property int $user_id
 * @property int $tweet_id
 * @property int $liked
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like query()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like whereLiked($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like whereTweetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Like whereUserId($value)
 */
	class Like extends \Eloquent {}
}

namespace App{
/**
 * App\Tweet
 *
 * @property int $id
 * @property int $user_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet query()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\Tweet withLikes()
 */
	class Tweet extends \Eloquent {}
}

namespace App{
/**
 * App\User
 *
 * @property int $id
 * @property string $username
 * @property string $name
 * @property string|null $avatar
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $followees
 * @property-read int|null $followees_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Like[] $likes
 * @property-read int|null $likes_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tweet[] $tweets
 * @property-read int|null $tweets_count
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Models\User whereUsername($value)
 */
	class User extends \Eloquent {}
}

