<x-master>
    <div class="flex justify-center">
        <div class="w-1/2">
            <div class="text-3xl text-gray-500 w-full text-center mb-4">{{ __('Login') }}</div>
            <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                            {{ __('E-Mail Address') }}
                        </label>
                    </div>
                    <div class="md:w-2/4">
                        <input class="  bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                        text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                        @error('email') border-red-500 @enderror"
                               id="email"
                               type="text"
                               name="email"
                               value="{{ old('email') }}"
                               required
                               autocomplete="email"
                               autofocus
                               placeholder="Your E-Mail"
                        >
                    </div>
                    @error('email')
                        <span class="text-red-500 text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">
                            {{ __('Password') }}
                        </label>
                    </div>
                    <div class="md:w-2/4">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                      text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                      @error('password') border-red-500 @enderror"
                               name="password"
                               required
                               autocomplete="current-password"
                               id="password"
                               type="password"
                               placeholder="******************">
                    </div>
                    @error('password')
                    <span class="text-sm text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3"></div>
                    <label class="md:w-2/3 block text-gray-500 font-bold" for="remember">
                        <input class="mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span class="text-sm text-black">
                            {{ __('Remember Me') }}
                        </span>
                    </label>
                </div>
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-1/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                            {{ __('Login') }}
                        </button>
                    </div>
                    <div class="md:w-1/3">
                        @if (Route::has('password.request'))
                            <a class="text-blue-500 hover:text-blue-800" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-master>
