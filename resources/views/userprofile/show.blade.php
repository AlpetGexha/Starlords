<x-app-layout>
    <x-slot name="header">
        {{ __('My Organization') }}
    </x-slot>


    <div class="container mx-auto">
        {{-- Event: {{ count($events) }} --}}
        <x-event-section>
            @forelse ($profiles as $profile)
                <a href="{{ route('profile.single', ['profile' => $profile->slug]) }}">
                    <div class="transition-all duration-150 flex w-full px-4 py-3 md:w-1/2 lg:w-1/3">
                        <div
                            class="flex flex-col items-stretch min-h-full pb-4 mb-6 transition-all duration-150 bg-white rounded-lg shadow-lg hover:shadow-2xl">
                            <div class="md:flex-shrink-0">
                                <img src="{{ $profile->getImage() }}" alt="{{ $profile->name }}"
                                    class="object-fill w-full rounded-lg rounded-b-none md:h-56" />
                            </div>
                            <div class="flex flex-wrap items-center flex-1 px-4 text-center mx-auto">
                                <a href="{{ route('profile.show', ['profile' => $profile->slug]) }}"
                                    class="hover:underline">
                                    <h2 class="text-2xl font-bold tracking-normal text-gray-800">
                                        <span>
                                            {{ $profile->name }}
                                        </span>
                                    </h2>
                                </a>
                            </div>
                            <p
                                class="flex flex-row flex-wrap w-full px-4 py-2 overflow-hidden text-sm text-justify text-gray-700">
                                {{ Str::removeHTML($profile->body) }}
                            </p>
                            <hr class="border-gray-300" />
                            <section class="px-4 py-2 mt-2">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center flex-1">
                                        <div class="flex flex-col mx-2">
                                            <a href="{{ route('profile.edit', ['profile' => $profile->slug]) }}"
                                                class="font-semibold text-gray-700 hover:underline">
                                                {{ __('Edit') }}
                                            </a>
                                            <span class="mx-1 text-xs text-gray-600">
                                                {{-- {{ Str::getFullDate($profile->created_at) }} --}}
                                            </span>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-600">
                                        {{-- {{ Str::readTime($profile->body) }} {{ __('Minutes Read') }} --}}
                                    </p>
                                </div>
                            </section>
                        </div>
                    </div>
                </a>
            @empty
                <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/x-circle -->
                            <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <div class="mt-2 text-sm text-red-700">
                                <p>
                                    {{ __('No Organization Found') }} <span class="text-blue-500"> <a
                                            href="{{ rotue('profile.create') }}">Create One</a></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </x-event-section>
        <div class="mx-auto px-4 sm:px-6">
            <div class="max-w-2xl mx-auto lg:max-w-none">
                <div class="ml-4 mt-2 flex-shrink-0">
                    {{ $profiles->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
