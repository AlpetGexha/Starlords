<x-app-layout>
    <div class=" pt-16 pb-12 flex flex-col ">
        <main class="flex-grow flex flex-col justify-center max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="py-16">
                <div class="text-center">
                    <p class="text-sm font-semibold text-indigo-600 uppercase tracking-wide">
                        @yield('code')
                    </p>

                    <h1 class="mt-2 text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                        @yield('code_error')
                    </h1>

                    <p class="mt-2 text-base text-gray-500">@yield('message')</p>
                    <div class="mt-6">
                        <a href="{{ route('homepage') }}"
                            class="text-base font-medium text-indigo-600 hover:text-indigo-500">
                            Go back home
                            <span aria-hidden="true"> &rarr;</span>
                        </a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-app-layout>
