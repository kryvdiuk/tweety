@php
    $followersByRetweetedTweet = $tweet->getFollowersByRetweetedTweet()
@endphp
        <div class="px-2 pb-2 pt-2 {{ $loop->last ? ' ' : 'border-b-2'}} hover:bg-gray-100">
            @if($tweet->retweets->count())
                @if(($page === "profile" && $tweet->isRetweetedBy(auth()->user()) && $tweet->user_id !== auth()->id()) ||
                ($page === "home" && $tweet->isRetweetedBy(auth()->user())) ||
                ($page === "home" && $followersByRetweetedTweet->count() !== 0))
                <div class="flex text-gray-500 text-xs cursor-pointer mb-2">
                <button class="mr-2">
                    <svg height="16px"
                             id="Layer_1"
                             viewBox="0 0 100 100"
                             width="16px"
                             xml:space="preserve"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                        >
                        <g class="fill-current">
                            <defs>
                                <rect height="100" id="SVGID_1_" width="100"/>
                            </defs>
                            <path d="M23.102,76.5c-1.854,0-3.361-1.514-3.361-3.372V45.664L5,45.657l20.029-21.924l20.037,21.931   H30.305v20.235h15.85L56.541,76.5H23.102z M95,54.344H80.254V26.872c0-1.859-1.508-3.372-3.361-3.372H43.461L53.84,34.101h15.847   v20.235l-14.751,0.008l20.035,21.928L95,54.344z"/>
                        </g>
                    </svg>
                </button>
                <div>
                    {!! $tweet->getRetweetTitle($page) !!}
                </div>
            </div>
        @endif
    @endif
    <div class="flex flex-shrink">
        <a href="{{ $tweet->user->path() }}">
            <div class="flex-shrink-0 mr-4">
                <img src="{{ $tweet->user->avatar == null ? '/images/default-avatar.png' : '/storage/' . $tweet->user->avatar }}"
                     alt="Avatar"
                     width="50"
                     class="rounded-full">
            </div>
        </a>
        <div>
            <div class="flex text-sm">
                <div class="font-bold mb-2 mr-1 hover:underline">
                    <a href="{{ $tweet->user->path() }}">{{ $tweet->user->name }}</a>
                </div>
                <a class="flex mr-2" href="{{ $tweet->user->path() }}">
                    <span>@</span>
                    {{ $tweet->user->username }}
                </a>
                <div class="text-gray-500 mr-2">
                    &#183;
                </div>
                <div class="hover:underline cursor-pointer text-gray-600">
                    {{ $tweet->created_at->diffForHumans() }}
                </div>
            </div>
            <div class="mb-2">{{ $tweet->body }}</div>
            <div class="flex w-full justify-start text-gray-500">
                <div class="flex mr-3 {{ $tweet->isLikedBy(auth()->user()) ? 'text-red-500': ''}}">
                    <form method="POST" action="/tweets/{{ $tweet->id }}/likes">
                        @csrf
                        @if($tweet->isLikedBy(auth()->user()))
                            @method("DELETE")
                        @endif
                        <button type="submit">
                            <svg viewBox="0 0 20 20" class="w-4 mr-1 hover:text-red-500">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g class="fill-current">
                                        <path d="M11.0010436,0 C9.89589787,0 9.00000024,0.886706352 9.0000002,1.99810135 L9,8 L1.9973917,8 C0.894262725,8 0,8.88772964 0,10 L0,12 L2.29663334,18.1243554 C2.68509206,19.1602453 3.90195042,20 5.00853025,20 L12.9914698,20 C14.1007504,20 15,19.1125667 15,18.000385 L15,10 L12,3 L12,0 L11.0010436,0 L11.0010436,0 Z M17,10 L20,10 L20,20 L17,20 L17,10 L17,10 Z"
                                              id="Fill-97">
                                        </path>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </form>
                    <div class="text-xs">
                        {{ $tweet->likes ? $tweet->likes()->count() : '0' }}
                    </div>
                </div>
                <div class="flex mr-3 {{ $tweet->isDislikedBy(auth()->user()) ? 'text-red-500': ''}}">
                    <form method="POST" action="/tweets/{{ $tweet->id }}/{{ $tweet->isDislikedBy(auth()->user()) ? 'likes' : 'dislikes' }}">
                        @csrf
                        @if($tweet->isDislikedBy(auth()->user()))
                            @method("DELETE")
                        @endif
                        <button>
                            <svg viewBox="0 0 20 20" class="w-4 mr-1 hover:text-red-500">
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g class="fill-current">
                                        <path d="M11.0010436,20 C9.89589787,20 9.00000024,19.1132936 9.0000002,18.0018986 L9,12 L1.9973917,12 C0.894262725,12 0,11.1122704 0,10 L0,8 L2.29663334,1.87564456 C2.68509206,0.839754676 3.90195042,8.52651283e-14 5.00853025,8.52651283e-14 L12.9914698,8.52651283e-14 C14.1007504,8.52651283e-14 15,0.88743329 15,1.99961498 L15,10 L12,17 L12,20 L11.0010436,20 L11.0010436,20 Z M17,10 L20,10 L20,0 L17,0 L17,10 L17,10 Z" id="Fill-97"></path>
                                    </g>
                                </g>
                            </svg>
                        </button>
                    </form>
                    <div class="text-xs">
                        {{ $tweet->likes ? $tweet->dislikes()->count() : '0' }}
                    </div>
                </div>
                <div class="flex mr-3 {{ $tweet->isRetweetedBy(auth()->user()) ? 'text-blue-500': ''}}">
                    <form method="POST" action="/tweets/{{ $tweet->id }}/retweet">
                        @csrf
                        <button>
                            <svg height="24px"
                                 id="Layer_1"
                                 class="hover:text-blue-500"
                                 viewBox="0 0 100 100"
                                 width="24px"
                                 xml:space="preserve"
                                 xmlns="http://www.w3.org/2000/svg"
                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                            >
                            <g class="fill-current">
                                <defs>
                                    <rect height="100" id="SVGID_1_" width="100"/>
                                </defs>
                                <path d="M23.102,76.5c-1.854,0-3.361-1.514-3.361-3.372V45.664L5,45.657l20.029-21.924l20.037,21.931   H30.305v20.235h15.85L56.541,76.5H23.102z M95,54.344H80.254V26.872c0-1.859-1.508-3.372-3.361-3.372H43.461L53.84,34.101h15.847   v20.235l-14.751,0.008l20.035,21.928L95,54.344z"/>
                            </g>
                        </svg>
                        </button>
                    </form>
                    <div class="text-xs">
                        {{ count($tweet->retweets) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


