<div>
    <style>
        input[type=range]::-webkit-slider-thumb {
            pointer-events: all;
            width: 24px;
            height: 24px;
            -webkit-appearance: none;
            /* @apply w-6 h-6 appearance-none pointer-events-auto; */
        }
    </style>
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
                                Price
                            </legend>

                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">
                                <div class="flex items-center text-base sm:text-sm">
                                    <div x-data="range()" x-init="mintrigger();
                                    maxtrigger()"
                                        class="relative max-w-xl w-full">
                                        <div>
                                            <input type="range" step="1" x-bind:min="min"
                                                x-bind:max="max" x-on:input="mintrigger" x-model="minprice"
                                                class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

                                            <input type="range" step="1" x-bind:min="min"
                                                wire:model.debounce.300="maxPrice" x-bind:max="max"
                                                x-on:input="maxtrigger" x-model="maxprice"
                                                class="absolute pointer-events-none appearance-none z-20 h-2 w-full opacity-0 cursor-pointer">

                                            <div class="relative z-10 h-2">

                                                <div
                                                    class="absolute z-10 left-0 right-0 bottom-0 top-0 rounded-md bg-gray-200">
                                                </div>

                                                <div class="absolute z-20 top-0 bottom-0 rounded-md bg-blue-500"
                                                    x-bind:style="'right:' + maxthumb + '%; left:' + minthumb + '%'">
                                                </div>

                                                <div class="absolute z-30 w-6 h-6 top-0 left-0 bg-blue-500 rounded-full -mt-2 -ml-1"
                                                    x-bind:style="'left: ' + minthumb + '%'"></div>

                                                <div class="absolute z-30 w-6 h-6 top-0 right-0 bg-blue-500 rounded-full -mt-2 -mr-3"
                                                    x-bind:style="'right: ' + maxthumb + '%'"></div>

                                            </div>

                                        </div>

                                        <div class="flex justify-between items-center py-5">
                                            <div>
                                                <x-inputs.currency maxlength="5" x-on:input="mintrigger"
                                                    x-model="minprice"
                                                    class="px-3 py-2 border border-gray-200 rounded w-24 text-center"
                                                    prefix="€" thousands="." decimal=","
                                                    wire:model="minPrice" />
                                            </div>
                                            <div>
                                                <x-inputs.currency maxlength="5" x-on:input="maxtrigger"
                                                    x-model="maxprice"
                                                    class="px-3 py-2 border border-gray-200 rounded w-24 text-center"
                                                    prefix="€" thousands="." decimal=","
                                                    wire:model.debounce.300="maxPrice" />
                                            </div>
                                        </div>

                                        Min: {{ $minPrice }}
                                        Max: {{ $maxPrice }}
                                    </div>

                                    <script>
                                        function range() {
                                            return {
                                                minprice: 1,
                                                maxprice: 300,
                                                min: 1,
                                                max: 300,
                                                minthumb: 0,
                                                maxthumb: 0,

                                                mintrigger() {
                                                    this.minprice = Math.min(this.minprice, this.maxprice - 1);
                                                    this.minthumb = ((this.minprice - this.min) / (this.max - this.min)) * 100;
                                                },

                                                maxtrigger() {
                                                    this.maxprice = Math.max(this.maxprice, this.minprice + 1);
                                                    this.maxthumb = 100 - (((this.maxprice - this.min) / (this.max - this.min)) * 100);
                                                },
                                            }
                                        }
                                    </script>
                                </div>
                            </div>

                        </fieldset>

                        <fieldset>
                            <legend class="block font-medium">
                                Category
                            </legend>
                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">

                                {{-- apline --}}
                                @foreach ($categories as $c)
                                    <div class="flex items-center text-base sm:text-sm">
                                        <x-checkbox id="category-{{ $c->id }}" wire:model="category"
                                            value="{{ $c->id }}"
                                            class="flex-shrink-0 h-4 w-4 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200" />
                                        <label for="category-{{ $c->id }}"
                                            class="ml-3 min-w-0 flex-1 text-gray-600">
                                            {{ $c->title }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </fieldset>
                    </div>
                    <div class="grid grid-cols-1 gap-y-10 auto-rows-min md:grid-cols-2 md:gap-x-6">
                        <x-select label="Search a Organization" wire:model="organization"
                            placeholder="Select some Organization" multiple :async-data="route('api.organization')" :template="[
                                'name' => 'user-option',
                                'config' => ['src' => 'profile_image'],
                            ]"
                            option-label="name" option-value="slug" />
                        {{ $organization }}
                        {{-- <fieldset>
                            <legend class="block font-medium">
                                Size
                            </legend>
                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="size-0" name="size[]" value="xs" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="size-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        XS
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="size-1" name="size[]" value="s" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500"
                                        checked="">
                                    <label for="size-1" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        S
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="size-2" name="size[]" value="m" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="size-2" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        M
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="size-3" name="size[]" value="l" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="size-3" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        L
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="size-4" name="size[]" value="xl" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="size-4" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        XL
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="size-5" name="size[]" value="2xl" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="size-5" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        2XL
                                    </label>
                                </div>

                            </div>
                        </fieldset>
                        <fieldset>
                            <legend class="block font-medium">
                                Category
                            </legend>
                            <div class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="category-0" name="category[]" value="all-new-arrivals"
                                        type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="category-0" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        All New Arrivals
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="category-1" name="category[]" value="tees" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="category-1" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        Tees
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="category-2" name="category[]" value="objects" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="category-2" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        Objects
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="category-3" name="category[]" value="sweatshirts" type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="category-3" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        Sweatshirts
                                    </label>
                                </div>

                                <div class="flex items-center text-base sm:text-sm">
                                    <input id="category-4" name="category[]" value="pants-and-shorts"
                                        type="checkbox"
                                        class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
                                    <label for="category-4" class="ml-3 min-w-0 flex-1 text-gray-600">
                                        Pants &amp; Shorts
                                    </label>
                                </div>

                            </div>
                        </fieldset> --}}
                    </div>
                </div>
            </div>
            <div class="col-start-1 row-start-1 py-4">
                <div class="flex justify-end max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div x-data="{ open: false }" @keydown.escape.stop="open = false; focusButton()"
                        class="relative inline-block">
                        <div class="flex">
                            <button type="button"
                                class="group inline-flex justify-center text-sm font-medium text-gray-700 hover:text-gray-900"
                                id="menu-button" x-ref="button" @click="open = !open"
                                @keyup.space.prevent="onButtonEnter()" @keydown.enter.prevent="onButtonEnter()"
                                aria-expanded="false" aria-haspopup="true" x-bind:aria-expanded="open.toString()"
                                @keydown.arrow-up.prevent="onArrowUp()" @keydown.arrow-down.prevent="onArrowDown()">
                                Sort
                                <svg class="flex-shrink-0 -mr-1 ml-1 h-5 w-5 text-gray-400 group-hover:text-gray-500"
                                    x-description="Heroicon name: solid/chevron-down"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>


                        <div x-show="open" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-2xl bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                            x-ref="menu-items" x-description="Dropdown menu, show/hide based on menu state."
                            aria-labelledby="menu-button" tabindex="-1" @keydown.arrow-up.prevent="onArrowUp()"
                            @keydown.arrow-down.prevent="onArrowDown()" @keydown.tab="open = false"
                            @keydown.enter.prevent="open = false; focusButton()"
                            @keyup.space.prevent="open = false; focusButton()">
                            <div class="py-1" role="none">

                                <button wire:click="orderBy('views','desc')"
                                    class="font-medium text-gray-900 block px-4 py-2 text-sm" x-state:on="Active"
                                    x-state:off="Not Active" x-state:on:option.current="Selected"
                                    x-state:off:option.current="Not Selected"
                                    x-state-description="Selected: &quot;font-medium text-gray-900&quot;, Not Selected: &quot;text-gray-500&quot;"
                                    id="menu-item-0" @click="open = false; focusButton()">
                                    Most Popular
                                </button>

                                <button wire:click="orderBy('likes_count','desc')"
                                    class="text-gray-500 block px-4 py-2 text-sm"
                                    x-state-description="undefined: &quot;font-medium text-gray-900&quot;, undefined: &quot;text-gray-500&quot;"
                                    id="menu-item-1" @click="open = false; focusButton()">
                                    Most Liked
                                </button>

                                <button wire:click="orderBy('price','desc')"
                                    class="text-gray-500 block px-4 py-2 text-sm">
                                    Higher Price
                                </button>

                                <button wire:click="orderBy('price','asc')"
                                    class="text-gray-500 block px-4 py-2 text-sm">
                                    Lower Price
                                </button>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="container mx-auto">
        {{-- Event: {{ count($events) }} --}}
        <x-event-section>
            @forelse ($events as $event)
                <x-card-event :event='$event' />
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
                                {{ $search ? 'No Events Found' : 'No Events' }}</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul role="list" class="list-disc pl-5 space-y-1">
                                    <li>Try Searching Other Events</li>
                                    <li>Go <a href="{{ route('event.show') }}">Back</a> to Events Page</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </x-event-section>
        <div class="mx-auto px-4 sm:px-6">
            <div class="max-w-2xl mx-auto py-10 lg:max-w-none">
                <div class="ml-4 mt-2 flex-shrink-0">
                    {{ $events->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
{{-- <div x-data="{ categories: @js($categories) }" class="pt-6 space-y-6 sm:pt-4 sm:space-y-4">

    <template x-for="c in categories">
        <div class="flex items-center text-base sm:text-sm">
            <input wire:model="category"
                x-bind:value="c.id" type="checkbox"
                class="flex-shrink-0 h-4 w-4 border-gray-300 rounded text-indigo-600 focus:ring-indigo-500">
            <label x-bind:for="c.id" class="ml-3 min-w-0 flex-1 text-gray-600"
                x-text='c.title'>
            </label>
        </div>
    </template>

</div> --}}
