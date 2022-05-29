<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TweetsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|Response|View
     */
    public function index()
    {
        return view("tweets.index", [
            "tweets" => auth()->user()->timeline(),
            "followees" => auth()->user()->followees
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Application|RedirectResponse|Redirector|void
     */
    public function store()
    {
        $attributes = request()->validate(["body" => "required|max:255"]);
        Tweet::create([
            "user_id" => auth()->user()->id,
            "body" => $attributes["body"]
        ]);

        return redirect("/tweets");
    }
}
