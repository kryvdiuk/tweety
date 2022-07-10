<x-app>
    <p class="font-bold mb-8 text-2xl">
        Following
    </p>
    @forelse($followees as $followee)
        <div  class="flex items-center mb-3">
            <a href="{{ route('profile', $followee->username) }}">
                <img
                    src="{{ $followee->avatar == null ? '/images/default-avatar.png' : '/storage/' . $followee->avatar }}"
                    alt="Avatar"
                    class="rounded-full mr-2"
                    width="60"
                >
            </a>
            <a href="{{ route('profile', $followee->username) }}"
               class="font-bold">{{'@' . $followee->username }}
            </a>
        </div>
    @empty
        <h4>No followees</h4>
    @endforelse
</x-app>
