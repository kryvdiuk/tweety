<x-master>
    <div class="flex justify-center">
        <div class="w-1/3">
            <div class="text-3xl text-gray-500 w-full text-center mb-4">{{ __('Register') }}</div>
            <form method="POST" action="{{ route('register') }}" class="w-full">
                @csrf
                {{--USERNAME--}}
                <div class="md:flex md:items-center">
                    <div class="md:w-1/5">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="username">
                            Username
                        </label>
                    </div>
                    <div class="md:w-4/5">
                        <input class="  bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                    text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                    @error('username') border-red-500 @enderror"
                               id="username"
                               type="text"
                               name="username"
                               value="{{ old('username') }}"
                               required
                               autofocus
                               placeholder="Some unique username"
                        >
                    </div>
                </div>
                <div class="flex mb-2">
                    <div class="w-1/5"></div>
                    @error('username')
                        <span class="text-red-500 {{ strlen($message) > 50 ? 'text-xs' : 'text-sm' }}" role="alert">{{ $message }}</span>
                    @else
                        <span class="invisible">Invisible error </span>
                    @enderror
                </div>
                {{--NAME--}}
                <div class="md:flex md:items-center">
                    <div class="md:w-1/5">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                            Name
                        </label>
                    </div>
                    <div class="md:w-4/5">
                        <input class="  bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                        @error('name') border-red-500 @enderror"
                               id="name"
                               type="text"
                               name="name"
                               value="{{ old('name') }}"
                               required
                               placeholder="Your name"

                        >
                    </div>
                </div>
                <div class="flex mb-2">
                    <div class="w-1/5"></div>
                    @error('name')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @else
                        <span class="invisible">Invisible error </span>
                    @enderror
                </div>
                {{--EMAIL--}}
                <div class="md:flex md:items-center">
                    <div class="md:w-1/5">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                            {{ __('E-Mail Address') }}
                        </label>
                    </div>
                    <div class="md:w-4/5">
                        <input class="  bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                        @error('email') border-red-500 @enderror"
                               id="email"
                               type="text"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               placeholder="Your E-Mail"
                        >
                    </div>
                </div>
                <div class="flex mb-2">
                    <div class="w-1/5"></div>
                    @error('email')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @else
                        <span class="invisible">Invisible error </span>
                    @enderror
                </div>
                {{--PASSWORD--}}
                <div class="md:flex md:items-center">
                    <div class="md:w-1/5">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">
                            {{ __('Password') }}
                        </label>
                    </div>
                    <div class="md:w-4/5">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                      text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                      @error('password') border-red-500 @enderror"
                               name="password"
                               required
                               id="password"
                               type="password"
                               placeholder="******************">
                    </div>
                </div>
                <div class="flex mb-2">
                    <div class="w-1/5"></div>
                    @error('password')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @else
                        <span class="invisible">Invisible error </span>
                        @enderror
                </div>
                {{--PASSWORD-CONFIRMATION--}}
                <div class="md:flex md:items-center mb-4">
                    <div class="md:w-1/5">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="password_confirmation">
                            {{ __('Confirm Password') }}
                        </label>
                    </div>
                    <div class="md:w-4/5">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                      text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500"
                               id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               placeholder="******************">
                    </div>
                </div>
                {{--SUBMIT-BUTTON--}}
                <div class="md:flex md:items-center">
                    <div class="md:w-1/5"></div>
                    <div class="md:w-4/5">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            {{ __('Register') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-master>
