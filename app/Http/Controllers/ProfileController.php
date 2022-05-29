<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index(User $user)
    {
        $tweets = $user->tweets()->paginate(10);
        return view("profile.index", compact(["user", 'tweets']));
    }

    public function edit(User $user)
    {
        return view("profile.edit", compact("user"));
    }

    public function update(User $user)
    {
        $attributes = request()->validate([
            "username" => ["required", "string", "min:3", "max:255", "alpha_dash", Rule::unique("users")->ignore($user)],
            "name" => ["required", "string", "min:3", "max:255", ],
            "avatar" => ["file"],
            "email" => ["required", "string", "min:3", "max:255"," email", Rule::unique("users")->ignore($user)],
            "password" => ["required", "string", "min:3", "max:255", "confirmed"]
        ]);

        if(request("avatar"))
            $attributes["avatar"] = request("avatar")->store("avatars");

        $user->update($attributes);

        return redirect($user->path());
    }
}
