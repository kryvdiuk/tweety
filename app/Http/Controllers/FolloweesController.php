<?php

namespace App\Http\Controllers;

use App\Models\User;

class FolloweesController extends Controller
{
    public function index(User $user)
    {
        $followees = $user->followees;
        return view('profile.followees', compact(['user', 'followees']));
    }
}
