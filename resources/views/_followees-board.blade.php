<div class="px-8 py-4 bg-blue-100 rounded-lg">
    <h3 class="text-2xl font-bold mb-4">Follows</h3>

    @forelse(auth()->user()->followees as $followee)
        <a  class="flex items-center {{ $loop->last ? '' : 'mb-2' }}"
            href="{{ route('profile', $followee->username) }}"
        >
            <img src="{{ $followee->avatar == null ? '/images/default-avatar.png' : '/storage/' . $followee->avatar }}"
                 alt="Avatar"
                 class="rounded-full mr-2"
                 width="60"
            >
            <div class="font-bold">{{ $followee->username }}</div>
        </a>
    @empty
        <p class="pt-2 font-bold">No followees jet.</p>
    @endforelse
</div>
