<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;

class TweetLikesController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function storeLike(Tweet $tweet)
    {
        $tweet->like();

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function storeDislike(Tweet $tweet)
    {
        $tweet->dislike();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Tweet $tweet
     * @return RedirectResponse
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->unlike();

        return back();
    }
}
