<ul>
    <li class="text-xl mb-4 font-bold"><a href="{{ route("home") }}">Home</a></li>
    <li class="text-xl mb-4 font-bold"><a href="{{ route("explore") }}">Explore</a></li>
    <li class="text-xl mb-4 font-bold"><a href="{{ auth()->user()->path() }}">Profile</a></li>
    <li>
        <form method="POST" action="/logout">
            @csrf
            <button type="submit" class="text-xl mb-4 font-bold">Logout</button>
        </form>
    </li>
</ul>
