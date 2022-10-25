<x-app-layout>
    <div>
        <div>
            <img class="h-32 w-full object-cover lg:h-48"
                src="https://secureservercdn.net/160.153.138.10/q0n.55d.myftpupload.com/wp-content/uploads/2022/08/Home-Banner.jpg?time=1661200337"
                alt="">
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="-mt-12 sm:-mt-16 sm:flex sm:items-end sm:space-x-5">
                <div class="flex">
                    <img class="h-24 w-24 rounded-full ring-4 ring-white sm:h-32 sm:w-32"
                        src="{{ $user->profile_photo_url }}" alt="{{ $user->username() }}">
                </div>
                <div class="mt-6 sm:flex-1 sm:min-w-0 sm:flex sm:items-center sm:justify-end sm:space-x-6 sm:pb-1">
                    <div class="sm:hidden md:block mt-6 min-w-0 flex-1">
                        <div class="flex flex-row items-center gap-2">
                            <h1 class="text-2xl font-bold text-gray-900 truncate">{{ $user->username() }}</h1>
                            @if ($user->isVerified())
                                <s<i class=" fa-solid  fa-circle-check  text-blue-600 hover:text-blue-700"
                                    data-tooltip-target="tooltip-light" data-tooltip-style="light"></i>
                                    <div id="tooltip-light" role="tooltip"
                                        class="inline-block absolute invisible z-50 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
                                        {{ __('Verified') }} <div class="tooltip-arrow" data-popper-arrow></div>
                                    </div>
                            @endif


                        </div>
                    </div>
                    <div class="mt-6 flex flex-col justify-stretch space-y-3 sm:flex-row sm:space-y-0 sm:space-x-4">
                        <button type="button"
                            class="inline-flex justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500">
                            <!-- Heroicon name: solid/mail -->
                            <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                            </svg>
                            <span>Message</span>
                        </button>
                        <button type="button"
                            class="inline-flex justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <!-- Heroicon name: solid/phone -->

                            <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 border-gray-300"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <span>Subscribe</span>
                        </button>

                    </div>
                </div>
            </div>
            <div class="hidden sm:block md:hidden mt-6 min-w-0 flex-1">
                <h1 class="text-2xl font-bold text-gray-900 truncate">{{ $user->username() }}</h1>
            </div>

            @if ($user->isPublic())

            {{-- @dd($user->profile) --}}
            @if ($user->hasProfile())

                <div class="pt-16 pb-20 ">
                    <div
                        class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl bg-white rounded-2xl p-10 shadow-md">
                        <div>
                            <h2 class="text-3xl tracking-tight font-bold text-gray-900 sm:text-4xl">
                                {{ __('Organization') }}
                            </h2>
                        </div>
                        <div class="mt-8 pt-8 ">
                            <div class="py-5 sm:px-0 sm:py-0 grid grid-cols-1 gap-2">
                                @forelse ($user->profile as $p)
                                    <div>
                                        <a href="{{ route('profile.single', ['profile' => $p->slug]) }}"
                                            class="flex flex-col p-2 my-3 items-center bg-white rounded-lg border shadow-lg md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                                            <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                                                src="{{ $p->getMedia('profile')->first()? $p->getMedia('profile')->first()->getUrl(): config('app.no_file') }}"
                                                alt="{{ $p->name }}">
                                            <div class="flex flex-col justify-between p-4 leading-normal">
                                                <h5
                                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white truncate">
                                                    {{ $p->name }}
                                                </h5>
                                                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                                                    {{ $p->body }}
                                                </p>
                                            </div>
                                        </a>
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>
                    </div>
                </div>
            @endif


            {{-- <div class="pt-16 pb-20  lg:pt-24 lg:pb-28 ">
                <div
                    class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl bg-white rounded-2xl p-10 shadow-md">
                    <div>
                        <h2 class="text-3xl tracking-tight font-bold text-gray-900 sm:text-4xl">Information
                        </h2>

                    </div>
                    <div class="mt-12 pt-12 ">

                        <div class="py-5 sm:px-0 sm:py-0">
                            <dl class="space-y-8 sm:divide-y sm:divide-gray-200 sm:space-y-0">
                                <div class="sm:flex sm:px-0 sm:py-8">
                                    <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0 lg:w-48">Bio
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:ml-6 sm:col-span-2">
                                        <p>Enim feugiat ut ipsum, neque ut. Tristique mi id elementum praesent. Gravida
                                            in
                                            tempus
                                            feugiat netus enim aliquet a, quam scelerisque. Dictumst in convallis nec in
                                            bibendum
                                            aenean arcu.</p>
                                    </dd>
                                </div>
                                <div class="sm:flex sm:px-0 sm:py-8">
                                    <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0 lg:w-48">
                                        Location
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:ml-6 sm:col-span-2">Prishtinë</dd>
                                </div>
                                <div class="sm:flex sm:px-0 sm:py-8">
                                    <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0 lg:w-48">
                                        Website
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:ml-6 sm:col-span-2">
                                        sunnyhillfestival.com
                                    </dd>
                                </div>
                                <div class="sm:flex sm:px-0 sm:py-8">
                                    <dt class="text-sm font-medium text-gray-500 sm:w-40 sm:flex-shrink-0 lg:w-48">
                                        Events
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:ml-6 sm:col-span-2">46</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div> --}}

            @if ($user->hasEvent())
                <div class=" pb-20  lg:pb-28 ">
                    <div
                        class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl bg-white rounded-2xl p-10 shadow-md">
                        <div>
                            <h2 class="text-3xl tracking-tight font-bold text-gray-900 sm:text-4xl">
                                {{ __('Recent Events') }}
                            </h2>
                            <div class="mt-6 flex flex-wrap">
                                @forelse ($user->events as $event)
                                    <x-card-event :event='$event' />
                                @empty
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @else
                <strong class="text-center text-gray-500"><span>{{__('This user its Private')}}</span></strong>
            @endif

            {{-- <!-- This example requires Tailwind CSS v2.0+ -->
            <div class=" pt-16 pb-20  lg:pt-24 lg:pb-28 ">
                <div
                    class="relative max-w-lg mx-auto divide-y-2 divide-gray-200 lg:max-w-7xl bg-white rounded-2xl p-10 shadow-md">
                    <div>
                        <h2 class="text-3xl tracking-tight font-bold text-gray-900 sm:text-4xl">Recent Blogs
                        </h2>

                    </div>
                    <div class="mt-12 grid gap-16 pt-12 lg:grid-cols-3 lg:gap-x-5 lg:gap-y-12">


                        @for ($i = 0; $i < 5; $i++)
                            <div>
                                <div>
                                    <a href="#" class="inline-block">
                                        <span
                                            class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                            Article </span>
                                    </a>
                                </div>
                                <a href="#" class="block mt-4">
                                    <p class="text-xl font-semibold text-gray-900">News About Event</p>
                                    <p class="mt-3 text-base text-gray-500">Nullam risus blandit ac aliquam justo
                                        ipsum.
                                        Quam
                                        mauris volutpat massa dictumst amet. Sapien tortor lacus arcu.</p>
                                </a>
                                <div class="mt-6 flex items-center">
                                    <div class="flex-shrink-0">
                                        <a href="#">
                                            <span class="sr-only">Sunny Hill</span>
                                            <img class="h-10 w-10 rounded-full"
                                                src="https://scontent.fprn12-1.fna.fbcdn.net/v/t39.30808-6/297104540_1878627388992751_924389478373328361_n.jpg?_nc_cat=1&ccb=1-7&_nc_sid=09cbfe&_nc_ohc=BAd27UWbW6QAX_f-o7J&_nc_ht=scontent.fprn12-1.fna&oh=00_AT_ehn0sWUy0qrM6w4zr9ynb0Qopf-HUIKJ87l1tetS10A&oe=630A1C4D"
                                                alt="">
                                        </a>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">
                                            <a href="#"> Sunny Hill </a>
                                        </p>
                                        <div class="flex space-x-1 text-sm text-gray-500">
                                            <time datetime="2020-03-16"> June 16, 2022 </time>
                                            <span aria-hidden="true"> &middot; </span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor



                    </div>
                </div>
            </div> --}}
        </div>
    </div>
</x-app-layout>
