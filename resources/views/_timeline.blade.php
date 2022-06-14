<div class="overflow-hidden rounded-lg border-2">
    @forelse($tweets as $tweet)
        @include("_tweet", ["page" => $page ?? "home"])
    @empty
        <p class="p-4 text-center">No tweets jet.</p>
    @endforelse
</div>

<div class="m-2">{{ $tweets->links() }}</div>
