<x-app-layout>
    {{-- First 2 photo --}}
    <section class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-9 px-4">
        <div class="flex lg:flex-row flex-col justify-between gap-8 pt-12">
            <div class="w-full lg:w-5/12 flex flex-col justify-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 pb-4">
                    {{ __($s->welcome) }}
                </h1>
            </div>
            <div class="w-full lg:w-8/12">
                <img class="w-full h-full rounded-3xl"
                loading="lazy"
                    src="https://media.istockphoto.com/photos/group-portrait-of-a-creative-business-team-standing-outdoors-three-picture-id1146473249?k=20&m=1146473249&s=612x612&w=0&h=9Ki3nKs4Su-_YRMc6__iuWnHLhpp58ULOsz4l9PT6tw="
                    alt="A group of People on {{ env('APP_NAME') }}" />
            </div>
        </div>
        <div class="flex flex-col mt-5 lg:flex-row justify-between gap-8">
            <div class="w-full lg:w-8/12">
                <img class="w-full h-full rounded-3xl"
                loading="lazy"
                    src="https://www.allearsenglish.com/wp-content/uploads/2018/12/adress-group-of-people-in-English.jpeg"
                    alt="A group of People on {{ env('APP_NAME') }}" />
            </div>
            <div class="w-full lg:w-5/12 flex flex-col justify-center">
                <h1 class="text-3xl lg:text-4xl font-bold leading-9 text-gray-800 pb-4"> {{ __('About Us') }} </h1>
                <p class="font-normal text-base leading-6 text-gray-600">
                    {{ __($s->aboutus) }}
                </p>
            </div>
        </div>
    </section>

    {{-- Motive Word --}}
    <section class="px-4 py-10 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-15">
        <div class="max-w-xl mb-10 md:mx-auto sm:text-center lg:max-w-2xl md:mb-12">
            <h2
                class="max-w-lg mb-6 font-sans text-3xl font-bold leading-none tracking-tight text-gray-900 sm:text-4xl md:mx-auto">
                <span class="relative inline-block">
                    <svg viewBox="0 0 52 24" fill="currentColor"
                        class="absolute top-0 left-0 z-0 hidden w-32 -mt-8 -ml-20 text-blue-gray-100 lg:w-32 lg:-ml-28 lg:-mt-10 sm:block">
                        <defs>
                            <pattern id="db164e35-2a0e-4c0f-ab05-f14edc6d4d30" x="0" y="0"
                                width=".135" height=".30">
                                <circle cx="1" cy="1" r=".7"></circle>
                            </pattern>
                        </defs>
                        <rect fill="url(#db164e35-2a0e-4c0f-ab05-f14edc6d4d30)" width="52" height="24"></rect>
                    </svg>
                    <span class="relative">We</span>
                </span>
                {{ __($s->words) }}
            </h2>
            <p class="text-base text-gray-700 md:text-lg">
                {{ __($s->words_body) }}
            </p>
        </div>
    </section>

    {{-- Explore how we got here --}}
    <section class="2xl:container 2xl:mx-auto lg:py-16 lg:px-20 md:py-12 md:px-6 py-4 px-4">
        <div class="flex lg:flex-row flex-col justify-between gap-8 pt-12">
            <div class="flex flex-col mt-5 lg:flex-row justify-between gap-8">
                <div class="w-full lg:w-8/12">
                    <h4 class="font-semibold text-4xl text-center mb-6">Explore how we got here </h4>
                    <img class="w-full h-full rounded-3xl"
                    loading="lazy"
                        src="https://www.universe.com/marketing_assets/static/about/timeline/jarvis_desks-7aa16f97aab4ee10392344452458d4e0e13979ed33483e08ecaf995a1f025f63.png"
                        alt="A group of People" />
                </div>

                <ol class="border-l border-gray-300">
                    <li>
                        <div class="flex flex-start items-center pt-3">
                            <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 mr-3"></div>
                            <p class="text-gray-500 text-sm">01.07.2022</p>
                        </div>
                        <div class="mt-0.5 ml-4 mb-6">
                            <h4 class="text-gray-800 font-semibold text-xl mb-1.5">2022 MAR</h4>
                            <p class="text-gray-500 mb-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="flex flex-start items-center pt-2">
                            <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 mr-3"></div>
                            <p class="text-gray-500 text-sm">13.09.2022</p>
                        </div>
                        <div class="mt-0.5 ml-4 mb-6">
                            <h4 class="text-gray-800 font-semibold text-xl mb-1.5">2021 APR</h4>
                            <p class="text-gray-500 mb-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="flex flex-start items-center pt-2">
                            <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 mr-3"></div>
                            <p class="text-gray-500 text-sm">25.11.2021</p>
                        </div>
                        <div class="mt-0.5 ml-4 pb-5">
                            <h4 class="text-gray-800 font-semibold text-xl mb-1.5">2022 AUG</h4>
                            <p class="text-gray-500 mb-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </li>
                </ol>
                <ol class="border-l border-gray-300">
                    <li>
                        <div class="flex flex-start items-center pt-3">
                            <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 mr-3"></div>
                            <p class="text-gray-500 text-sm">01.07.2022</p>
                        </div>
                        <div class="mt-0.5 ml-4 mb-6">
                            <h4 class="text-gray-800 font-semibold text-xl mb-1.5">2022 MAR</h4>
                            <p class="text-gray-500 mb-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="flex flex-start items-center pt-2">
                            <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 mr-3"></div>
                            <p class="text-gray-500 text-sm">13.09.2022</p>
                        </div>
                        <div class="mt-0.5 ml-4 mb-6">
                            <h4 class="text-gray-800 font-semibold text-xl mb-1.5">2021 APR</h4>
                            <p class="text-gray-500 mb-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </li>
                    <li>
                        <div class="flex flex-start items-center pt-2">
                            <div class="bg-gray-300 w-2 h-2 rounded-full -ml-1 mr-3"></div>
                            <p class="text-gray-500 text-sm">25.11.2021</p>
                        </div>
                        <div class="mt-0.5 ml-4 pb-5">
                            <h4 class="text-gray-800 font-semibold text-xl mb-1.5">2022 AUG</h4>
                            <p class="text-gray-500 mb-3">
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            </p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </section>
    <br><br><br><br>
    {{-- Location --}}

    {{--
        <section class="overflow-hidden text-gray-700">
        <h1 class="text-center  font-bold text-2xl text-gray-800 pb-4">
            OUR LOCATIONS
        </h1>
        <div class="container px-2 py-2 mx-auto lg:pt-6 lg:px-16">
            <div class="flex flex-wrap -m-1 md:-m-2">
                <div class="flex flex-wrap w-1/4">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                            src="https://www.universe.com/marketing_assets/static/about/offices/toronto-6eeae92d4a4ff0aa6dea3ecd8b0a515bc11d8facdecc139af973fa1de320b77c.png">
                        <h2 class="font-bold text-xl">Toronto</h2>
                    </div>
                    <p class="text-xl font-light leading-relaxed mt-6 mb-4 text-gray-800">
                        102-17 Phoebe Street,
                        Toronto, ON M5T 1A8
                    </p>
                </div>
                <div class="flex flex-wrap w-1/4">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                            src="https://www.universe.com/marketing_assets/static/about/offices/san-fran-050398485ddb7f7ef2c236218ff3c26e50528c640919b3e1bf2bcd4c7657b6a2.png">
                        <h2 class="font-bold text-xl"> San Francisco </h2>
                    </div>
                    <p class="text-xl font-light leading-relaxed mt-6 mb-4 text-gray-800">
                        2 Jackson Street, #200,</br>
                        San Francisco, CA 94111
                    </p>
                </div>
                <div class="flex flex-wrap w-1/4">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                            src="https://www.universe.com/marketing_assets/static/about/offices/new-york-516673920e70b1d16180fb6eff0077ce91cada1b301479b86f8b7df7de85de94.png">
                        <h2 class="font-bold text-xl"> New York </h2>
                    </div>
                    <p class="text-xl font-light leading-relaxed mt-6 mb-4 text-gray-800">
                        430 W 15th Street,</br>
                        New York, NY 10014
                    </p>
                </div>
                <div class="flex flex-wrap w-1/4">
                    <div class="w-full p-1 md:p-2">
                        <img alt="gallery" class="block object-cover object-center w-full h-full rounded-lg"
                            src="https://www.universe.com/marketing_assets/static/about/offices/london-0e429c4097655f17fc581159fbf7b89c74cf794754f2bf92afb6d3b2e4ea83c4.png">
                        <h2 class="font-bold text-xl"> London </h2>

                    </div>
                    <p class="text-xl font-light leading-relaxed mt-6 mb-4 text-gray-800">
                        4 Pentonville Road,</br>
                        London N1 9HF, UK
                    </p>
                </div>
            </div>
        </div>
        </section>
     --}}

    {{-- Team Section --}}
    <livewire:about.team />

    {{-- Fakt --}}
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.js"></script>
        <script>
            $(".count").counterUp({
                delay: 10,
                time: 1500
            });
        </script>
    @endpush
    <section class="container my-12 px-6 mx-auto">
        <div class="mb-32 text-gray-800 text-center">
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-x-6 lg:gap-x-0 items-center">
                <div class="mb-12 lg:mb-0 relative">
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-6" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M488.6 250.2L392 214V105.5c0-15-9.3-28.4-23.4-33.7l-100-37.5c-8.1-3.1-17.1-3.1-25.3 0l-100 37.5c-14.1 5.3-23.4 18.7-23.4 33.7V214l-96.6 36.2C9.3 255.5 0 268.9 0 283.9V394c0 13.6 7.7 26.1 19.9 32.2l100 50c10.1 5.1 22.1 5.1 32.2 0l103.9-52 103.9 52c10.1 5.1 22.1 5.1 32.2 0l100-50c12.2-6.1 19.9-18.6 19.9-32.2V283.9c0-15-9.3-28.4-23.4-33.7zM358 214.8l-85 31.9v-68.2l85-37v73.3zM154 104.1l102-38.2 102 38.2v.6l-102 41.4-102-41.4v-.6zm84 291.1l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6zm240 112l-85 42.5v-79.1l85-38.8v75.4zm0-112l-102 41.4-102-41.4v-.6l102-38.2 102 38.2v.6z">
                        </path>
                    </svg>
                    <h5 class="text-lg font-medium text-blue-600 font-bold mb-4">
                        <span class="count">5000</span>
                    </h5>
                    <h6 class="font-medium text-gray-500">Components</h6>
                    <hr class="absolute right-0 top-0 w-px bg-gray-200 h-full hidden lg:block" />
                </div>

                <div class="mb-12 lg:mb-0 relative">
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-6" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 512 512">
                        <path fill="currentColor"
                            d="M12.41 148.02l232.94 105.67c6.8 3.09 14.49 3.09 21.29 0l232.94-105.67c16.55-7.51 16.55-32.52 0-40.03L266.65 2.31a25.607 25.607 0 0 0-21.29 0L12.41 107.98c-16.55 7.51-16.55 32.53 0 40.04zm487.18 88.28l-58.09-26.33-161.64 73.27c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.51 209.97l-58.1 26.33c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 276.3c16.55-7.5 16.55-32.5 0-40zm0 127.8l-57.87-26.23-161.86 73.37c-7.56 3.43-15.59 5.17-23.86 5.17s-16.29-1.74-23.86-5.17L70.29 337.87 12.41 364.1c-16.55 7.5-16.55 32.5 0 40l232.94 105.59c6.8 3.08 14.49 3.08 21.29 0L499.59 404.1c16.55-7.5 16.55-32.5 0-40z" />
                    </svg>
                    <h5 class="text-lg font-medium text-blue-600 font-bold mb-4">
                        <span class="count">490</span>
                    </h5>
                    <h6 class="font-medium text-gray-500">Design blocks</h6>
                    <hr class="absolute right-0 top-0 w-px bg-gray-200 h-full hidden lg:block" />
                </div>

                <div class="mb-12 md:mb-0 relative">
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 010 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 010-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375z" />
                      </svg>
                    <h5 class="text-lg font-medium text-blue-600 font-bold mb-4">
                        <span class="count">{{ $tickets_count }}</span>
                    </h5>
                    <h6 class="font-medium text-gray-500">{{ __('Ticket Sold') }}</h6>
                    <hr class="absolute right-0 top-0 w-px bg-gray-200 h-full hidden lg:block" />
                </div>

                <div class="relative">
                    <svg class="w-12 h-12 text-blue-600 mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                      </svg>
                    <h5 class="text-lg font-medium text-blue-600 font-bold mb-4">
                        <span class="count">{{ $organizer_count }}</span>
                    </h5>
                    <h6 class="font-medium text-gray-500 mb-0">{{ __('Organization') }}</h6>
                </div>
            </div>
        </div>
        <!-- Section: Design Block -->

    </section>

    {{-- Join Us --}}
    <section class="container my-12 px-6 mx-auto">
        <div class="p-12 text-center">
            <h4 class="font-semibold text-xl mb-6">
                {{ __($s->event) }}
            </h4>
            <x-buttonn class="px-6 py-3">
                <a href="{{ route('event.create') }}">
                    {{ _('Create an Event') }}
                </a>
            </x-buttonn>
        </div>
    </section>
</x-app-layout>
