<x-guest-layout>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-5xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img class="object-cover w-full h-full dark:block"
                        src="{{ asset('images/login.jpg') }}"
                        loading="lazy"
                        alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-sky-300 dark:text-sky-300">
                            {{ __('Login') }}
                        </h1>

                        <x-jet-validation-errors class="mb-4" />

                        @if (session('status'))
                            <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-blue-200 dark:text-blue-800" role="alert">
                                <span class="font-medium">{{ __('Status!') }}</span> {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Username: ') }}</span>
                                <x-jet-input id="username" class="block mt-1 w-full" type="text" name="username"
                                    :value="old('username')" required autofocus />
                            </label>

                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Password: ') }}</span>
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password"
                                    required autocomplete="current-password" />
                            </label>

                            <div class="block mt-4">
                                <label for="remember_me" class="flex items-center">
                                    <x-jet-checkbox id="remember_me" name="remember" />
                                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                                </label>
                            </div>


                            <x-buttonn
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center duration-150 transition-colors border-transparent rounded-lg bg-sky-300 ">
                                {{ __('Login') }}
                            </x-buttonn>
                        </form>

                        <hr class="my-5" />

                        <a href="{{ route('auth.provider', ['provaider' => 'google']) }}"
                            class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            <i class="w-4 h-4 mr-2 fa-brands fa-google"></i>
                            {{ __('Google') }}
                        </a>
                        <a href="{{ route('auth.provider', ['provaider' => 'facebook']) }}"
                            class="flex items-center justify-center w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                            <i class="w-4 h-4 mr-2 fa-brands fa-facebook"></i>
                            {{ __('Facebook') }}
                        </a>

                        @if (Route::has('password.request'))
                            <p class="mt-4">
                                <a class="text-sm font-medium text-sky-300 dark:text-blue-400 hover:underline"
                                    href="{{ route('password.request') }}">
                                    {{ __('Forgot your password?') }}
                                </a>
                            </p>
                        @endif
                        <p class="mt-1">
                            <a class="text-sm font-medium text-sky-300 dark:text-blue-400 hover:underline"
                                href="{{ route('register') }}">
                                {{ __('Create account') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>


