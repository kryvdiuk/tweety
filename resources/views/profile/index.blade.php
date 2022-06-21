<x-app>
    <div>
        <div class="relative">
            <img src="/images/default-profile-banner.jpg"
                 alt="Profile banner"
                 class="mb-4"
            >
            <img src="{{ $user->avatar == null ? '/images/default-avatar.png' : '/storage/' . $user->avatar }}"
                 alt="Avatar"
                 class="absolute rounded-full bottom-0 transform -translate-x-1/2 translate-y-1/2 w-40 h-40"
                 style="left:50%"
            >
        </div>
        <div class="mb-2 justify-between items-center flex">
            <div>
                <div class="font-bold text-2xl">{{ $user->name }}</div>
                <div class="text-sm text-gray-600">Joined {{ $user->created_at->diffForHumans() }}</div>
                <div class="flex">
                    <div class="mr-2 cursor-pointer hover:underline">
                        <a href="{{ $user->path() . "/following" }}">
                            <span class="font-bold">{{ $user->followees->count() }}</span> Following
                        </a>
                    </div>
                    <div class="cursor-pointer hover:underline">
                        <a href="{{ $user->path() . "/followers" }}">
                             <span class="font-bold">{{ $user->followers->count() }}</span> Followers
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex">
                @can("edit", $user)
                    <a href="{{ $user->path('edit') }}"
                       class="py-2 px-4 bg-gray-500 text-white hover:text-gray-500 hover:bg-white rounded-lg border
                              hover:border-gray-400 shadow focus:outline-none"
                    >
                        Edit Profile
                    </a>
                @endcan

                @unless(auth()->user()->is($user))
                    <form method="POST" action="/profile/{{ $user->username }}/follow">
                        @csrf
                        <button class="px-6 py-2 bg-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500
                                       hover:border-blue-400 hover:shadow border text-white rounded-lg focus:outline-none"
                                type="submit">
                            {{ auth()->user()->following($user) ? 'Unfollow' : 'Follow'}}
                        </button>
                    </form>
                @endunless
            </div>
        </div>
        <div class="mb-4">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
            et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
            ex ea commodo consequat.
        </div>
        @include('_timeline', ["tweets" => $tweets, "page" => "profile"])
    </div>
</x-app>

