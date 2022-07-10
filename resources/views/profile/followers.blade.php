<x-app>
    <p class="font-bold mb-8 text-2xl">
        Followers
    </p>
    @forelse($followers as $follower)
        <div  class="flex items-center mb-3">
            <a href="{{ route('profile', $follower->username) }}">
                <img
                    src="{{ $follower->avatar == null ? '/images/default-avatar.png' : '/storage/' . $follower->avatar }}"
                    alt="Avatar"
                    class="rounded-full mr-2"
                    width="60"
                >
            </a>
            <a href="{{ route('profile', $follower->username) }}"
               class="font-bold">{{'@' . $follower->username }}
            </a>
        </div>
    @empty
        <h4>No followers</h4>
    @endforelse
</x-app>
