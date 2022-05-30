<x-app>
    @forelse($users as $user)
        <div  class="flex items-center mb-3">
            <a href="{{ route('profile', $user->username) }}">
                <img
                    src="{{ $user->avatar == null ? '/images/default-avatar.png' : '/storage/' . $user->avatar }}"
                    alt="Avatar"
                    class="rounded-full mr-2"
                    width="60"
                >
            </a>
            <a href="{{ route('profile', $user->username) }}"
               class="font-bold">{{'@' . $user->username }}
            </a>
        </div>
    @empty
        <h4>No users</h4>
    @endforelse
    {{ $users->links() }}
</x-app>
