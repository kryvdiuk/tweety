<?php

namespace App\Http\Controllers;

use App\Models\User;

class FollowersController extends Controller
{
    public function index(User $user)
    {
        $followers = $user->followers;
        return view('profile.followers', compact(['user', 'followers']));
    }
}
