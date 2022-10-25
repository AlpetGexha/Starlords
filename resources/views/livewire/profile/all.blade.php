<div>
    <div class="bg-white">
        <!-- Filters -->
        <section x-data="{ open: false }" aria-labelledby="filter-heading"
            class="relative z-10 border-t border-b border-gray-200 grid items-center" x-cloak>
            <h2 id="filter-heading" class="sr-only">Filters</h2>
            <div class="relative col-start-1 row-start-1 py-4">
                <div class="max-w-7xl mx-auto flex space-x-6 divide-x divide-gray-200 text-sm px-4 sm:px-6 lg:px-8">
                    <div class="place-self-center">
                        <button type="button" class="group text-gray-700 font-medium flex items-center"
                            aria-controls="disclosure-1" @click="open = !open" aria-expanded="false"
                            x-bind:aria-expanded="open.toString()">
                            <svg class="flex-none w-5 h-5 mr-2 text-gray-400 group-hover:text-gray-500"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Filters
                        </button>
                    </div>
                    <div class="pl-6 place-self-center">
                        <button type="button" wire:click.prevent="clearAll()" class="text-gray-500">Clear all</button>
                    </div>
                    <div class="place-self-center">
                        <x-input type="search" wire:model='search' placeholder='Search' />
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-200 py-10" id="disclosure-1" x-show="open">
                <div class="max-w-7xl mx-auto grid grid-cols-2 gap-x-4 px-4 text-sm sm:px-6 md:gap-x-6 lg:px-8">
                    <div class="grid grid-cols-1 gap-y-10 auto-rows-min md:grid-cols-2 md:gap-x-6">
                        <fieldset>
                            <legend class="block font-medium">
                                <x-checkbox id="right-label" label="With event" wire:model="eventOnly" /> <br>
                                <x-checkbox id="right-label" label="With Active event" wire:model="withActiceEvent" />
                            </legend>
                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                {{--  --}}
                            </div>

                        </fieldset>

                        <fieldset>
                            <legend class="block font-medium">

                            </legend>
                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">

                            </div>
                        </fieldset>
                    </div>

                </div>
            </div>
            <div class="col-start-1 row-start-1 py-4">
                <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    {{--  --}}
                </div>
            </div>
        </section>
    </div>

    <div class="container mx-auto">
        {{-- Event: {{ count($events) }} --}}
        <x-event-section>
            @forelse ($proifiles as $profile)
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
                                        <img class="object-cover h-10 rounded-full"
                                            src="{{ $profile->user->avatar }}"alt="{{ $profile->title }}" />
                                        <div class="flex flex-col mx-2">
                                            <a class="font-semibold text-gray-700 hover:underline">
                                                {{ $profile->user->username() }}
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
                            <h3 class="text-sm font-medium text-red-800">
                                {{ $search ? 'No Organization Found' : 'No Organization' }}</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                    <li>Try Searching Other Organization</li>
                                    <li>Go <a href="{{ route('profile.show') }}">Back</a> to Organization Page</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </x-event-section>
        <div class="mx-auto px-4 sm:px-6">
            <div class="max-w-2xl mx-auto lg:max-w-none">
                <div class="ml-4 mt-2 flex-shrink-0">
                    {{ $proifiles->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
