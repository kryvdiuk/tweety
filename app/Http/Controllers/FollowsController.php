<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->toggleFollowee($user);

        return redirect()->back();
    }
}
