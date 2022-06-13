<x-master>
    @if (session('status'))
        <div class="absolute bg-green-700 p-2 rounded text-sm text-white ml-auto mr-auto w-1/5 left-0 right-0" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="flex justify-center md: mt-40">
        <div class="w-1/2">
            <div class="text-3xl text-gray-500 w-full text-center mb-4">{{ __('Reset Password') }}</div>
            <form method="POST" action="{{ route('password.email') }}" class="w-full">
                @csrf
                <div class="justify-between md:flex md:items-center mt-8">
                    <div class="md:w-1/3">
                        <label class="text-xl block text-black font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                            {{ __('E-Mail Address') }}
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <div >
                            <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
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
                    </div>
                </div>
                <div class="flex">
                    <div class="w-1/3"></div>
                    @error('email')
                        <span class="text-red-500 text-sm" role="alert">{{ $message }}</span>
                    @else
                        <span class="invisible">Invisible error </span>
                    @enderror
                </div>
                <div class="justify-end md:flex md:items-center">
                    <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded" type="submit">
                        {{ __('Send Password Reset Link') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-master>
