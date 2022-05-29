<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

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


//    /**
//     * Store a newly created resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Tweet $tweet)
//    {
//        $tweet->like(null, false);
//        return back();
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Tweet $tweet)
    {
        $tweet->unlike();

        return back();
    }
}
