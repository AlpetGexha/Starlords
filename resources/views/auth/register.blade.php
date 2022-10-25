<x-guest-layout>
    <div class="flex items-center min-h-screen p-6 bg-gray-50 dark:bg-gray-900">
        <div class="flex-1 h-full max-w-5xl mx-auto overflow-hidden bg-white rounded-lg shadow-xl dark:bg-gray-800">
            <div class="flex flex-col overflow-y-auto md:flex-row">
                <div class="h-32 md:h-auto md:w-1/2">
                    <img class="object-cover w-full h-full dark:block"
                        src="{{ asset('images/login.jpg') }}"
                        loading='lazy'
                        alt="Office" />
                </div>
                <div class="flex items-center justify-center p-6 sm:p-12 md:w-1/2">
                    <div class="w-full">
                        <h1 class="mb-4 text-xl font-semibold text-cyan-500 dark:text-cyan-200">
                            {{ __('Create account') }}
                        </h1>

                        <x-jet-validation-errors class="mb-4" />

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Name: ') }} </span>
                                <x-jet-input id="name"
                                    class="block mt-1 w-full {{ $errors->has('name') ? 'border-red-500' : '' }}"
                                    type="text" name="name" :value="old('name')" required autofocus
                                    autocomplete="name" />
                            </label>


                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Email: ') }} </span>
                                <x-jet-input id="email"
                                    class="block mt-1 w-full {{ $errors->has('email') ? 'border-red-500' : '' }}"
                                    type="email" name="email" :value="old('email')" required />
                            </label>


                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Username: ') }} </span>
                                <x-jet-input id="username"
                                    class="block mt-1 w-full {{ $errors->has('username') ? 'border-red-500' : '' }}"
                                    type="text" name="username" :value="old('username')" required autofocus
                                    autocomplete="username" />
                            </label>


                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Password: ') }} </span>
                                <x-jet-input id="password"
                                    class="block mt-1 w-full {{ $errors->has('password') ? 'border-red-500' : '' }} {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }}"
                                    type="password" name="password" required autocomplete="new-password" />
                            </label>


                            <label class="block text-sm mt-4">
                                <span class="text-gray-700 dark:text-gray-400">{{ __('Confirm: ') }} </span>
                                <x-jet-input id="password_confirmation"
                                    class="block mt-1 w-full {{ $errors->has('password_confirmation') ? 'border-red-500' : '' }} {{ $errors->has('password') ? 'border-red-500' : '' }}"
                                    type="password" name="password_confirmation" required autocomplete="new-password" />
                            </label>

                            <div class="form-group mt-3">
                                {!! NoCaptcha::renderJs('en', false, 'onloadCallback') !!}
                                {!! NoCaptcha::display(['data-theme' => 'dark']) !!}
                                @if ($errors->has('g-recaptcha-response'))
                                    <span class="help-block">
                                        <strong
                                            style="color: red;">{{ $errors->first('g-recaptcha-response') }}</strong>
                                    </span>
                                @endif
                            </div>

                            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                    'terms_of_service' =>
                                                        '<a target="_blank" href="' .
                                                        route('terms.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                                        __('Terms of Service') .
                                                        '</a>',
                                                    'privacy_policy' =>
                                                        '<a target="_blank" href="' .
                                                        route('policy.show') .
                                                        '" class="underline text-sm text-gray-600 hover:text-gray-900">' .
                                                        __('Privacy Policy') .
                                                        '</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                            @endif

                            <x-buttonn
                                class="block w-full px-4 py-2 mt-4 text-sm font-medium leading-5 text-center duration-150 transition-colors border-transparent rounded-lg bg-cyan-500">
                                {{ __('Register') }}
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

                        <p class="mt-4">
                            <a class="text-sm font-medium text-cyan-500 dark:text-blue-400 hover:underline"
                                href="{{ route('login') }}">
                                {{ __(' Already have an account? Login') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
<script>
    var onloadCallback = function() {
        alert("grecaptcha is ready");
    };
</script>
