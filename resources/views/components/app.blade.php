<x-master>
    <main class="mx-auto px-8">
        <div class="flex justify-between">
            <div class="lg:w-1/6 ml-10">
                @include("_links")
            </div>
            <div class="mx-10 flex-1 mb-10" style="max-width: 700px">
                {{ $slot }}
            </div>
            <div class="lg:w-1/6 ml-4">
                @include("_followees-board")
            </div>
        </div>
    </main>
</x-master>

