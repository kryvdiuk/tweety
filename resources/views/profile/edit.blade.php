<x-app>
    <div class="flex justify-center">
        <div class="w-full">
            <div class="text-3xl text-gray-500 w-full text-center mb-4">Edit profile</div>
            <form method="POST" action="{{ $user->path() }}" class="w-full max-w-xl" enctype="multipart/form-data">
                @csrf
                @method("PATCH")

                {{--USERNAME--}}
                <div class="md:flex md:items-center mb-6 w-full">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4"
                               for="username">
                            Username
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input  id="username"
                                class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                      text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                      @error('username') border-red-500 @enderror"
                                type="text"
                                name="username"
                                value="{{ $user->username }}"
                                required
                                autofocus
                        >
                    </div>
                    @error('username')
                    <span class="text-red-500 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{--NAME--}}
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="name">
                            Name
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input  id="name"
                                class="  bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                    text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                    @error('name') border-red-500 @enderror"
                                type="text"
                                name="name"
                                value="{{ $user->name }}"
                                required
                        >
                    </div>
                    @error('name')
                    <span class="text-red-500 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{--EMAIL--}}
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="email">
                            E-Mail
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input  id="email"
                                class="  bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                    text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                    @error('email') border-red-500 @enderror"
                               type="text"
                               name="email"
                               value="{{ $user->email }}"
                               required
                        >
                    </div>
                    @error('email')
                    <span class="text-red-500 text-sm" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{--AVATAR--}}
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="avatar">
                            Avatar
                        </label>
                    </div>
                    <div class="flex items-center justify-between md:w-2/3 pr-4 w-full">
                        <label class="bg-white border border-blue cursor-pointer flex hover:text-blue-700 items-center px-4 py-2 rounded-lg shadow-lg text-blue text-blue-500 tracking-wide uppercase w-64">
                            <svg class="w-8 h-8 mr-4" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="text-base leading-normal">Select a file</span>
                            <input type='file' class="hidden" name="avatar"/>
                        </label>
                        <img class="rounded-full"
                            src="{{ $user->avatar == null ? '/images/default-avatar.png' : '/storage/' . $user->avatar }}"
                             alt="Avatar"
                             width="50"
                        >
                    </div>
                </div>
                {{--PASSWORD--}}
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="password">
                            {{ __('Password') }}
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                  @error('password') border-red-500 @enderror"
                               name="password"
                               required
                               id="password"
                               type="password"
                               placeholder="******************"
                        >
                    </div>
                    @error('password')
                    <span class="text-sm text-red-500" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                {{--PASSWORD-CONFORMATION--}}
                <div class="md:flex md:items-center mb-6">
                    <div class="md:w-1/3">
                        <label class="block text-gray-500 font-bold md:text-right mb-1 md:mb-0 pr-4" for="password_confirmation">
                            {{ __('Confirm Password') }}
                        </label>
                    </div>
                    <div class="md:w-2/3">
                        <input class="bg-gray-200 appearance-none border-2 border-gray-200 rounded w-full py-2 px-4
                                  text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-blue-500
                                  @error('password') border-red-500 @enderror"
                               id="password_confirmation"
                               type="password"
                               name="password_confirmation"
                               required
                               placeholder="******************">
                    </div>
                </div>
                {{--SUBMIT-BUTTON--}}
                <div class="md:flex md:items-center">
                    <div class="md:w-1/3"></div>
                    <div class="md:w-2/3">
                        <button class="shadow bg-blue-500 hover:bg-blue-400 focus:shadow-outline focus:outline-none text-white font-bold py-2 px-4 rounded"
                                type="submit">
                            Edit
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app>
