<x-app>
    <div>
        <form action="/tweets" method="POST">
            @csrf

            <div class="rounded-lg border-2 border-blue-400 p-4 mb-6 shadow">
                <textarea name="body"
                          placeholder="What's up doc?"
                          class="w-full resize-none outline-none">
                </textarea>

                <hr class="my-4">

                @error("body")
                    <p class="text-sm text-red-500 my-2">{{ $message }}</p>
                @enderror

                <div class="flex justify-between items-center">
                    <div class="flex-shrink-0 ">
                        <img    src="{{ auth()->user()->avatar == null ? '/images/default-avatar.png' : '/storage/' . auth()->user()->avatar }}"
                                alt="Avatar"
                                width="40"
                                class="rounded-full"
                        >
                    </div>

                    <button class="px-6 py-2 bg-blue-500 hover:bg-white hover:text-blue-500 hover:border-blue-500
                                    hover:border-blue-400 hover:shadow border text-white rounded-lg focus:outline-none"
                            type="submit">Publish
                    </button>
                </div>
            </div>
        </form>

        @include("_timeline")
    </div>


</x-app>

