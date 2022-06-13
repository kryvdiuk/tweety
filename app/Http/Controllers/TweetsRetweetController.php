<?php

namespace App\Http\Controllers;

use App\Models\Tweet;

class TweetsRetweetController extends Controller
{
    public function store(Tweet $tweet)
    {
        auth()->user()->toggleRetweet($tweet);

        return redirect()->back();
    }
}
