<x-app-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/single-about.css') }}">
    @endpush
    <div id="middle">
        <div id="place" style="margin-top: 15rem">

            <div class="place-page">
                <div class="w c shadow-lg bg-white">
                    <div id="place_content" class="place-content">
                        <header class="place">
                            <figure class="avatar avatar-big">
                                <span>
                                    <img src="{{ $profile->getImage() }}"
                                        alt="{{ $profile->name }}" width="100" height="100"
                                        onerror="app.script.imageError(this, 'avatar');" />
                                </span>
                            </figure>
                            <div class="h1">
                                <h1>{{ $profile->name }}</h1>
                            </div>
                            <p>
                                <i class="fa-solid fa-location-dot"></i>
                                <span>
                                    {{ $profile->location }}
                                </span>
                            </p>
                            <p>
                                <i class="fa-solid fa-phone"></i>
                                <span><a href="tel:{{ $profile->phone }}">{{ $profile->phone }}</a></span>
                            </p>

                            @if ($profile->website)
                                <p>
                                    <i class="fa-solid fa-link"></i>
                                    <span>
                                        <a href="{{ $profile->website }}" target="_blank" title="{{ $profile->name }}">
                                            Website
                                        </a>
                                    </span>
                                </p>
                            @endif
                        </header>
                        <article class="page">
                            <table class="data">
                                <tbody>
                                    <tr>
                                        <th>Star: </th>
                                        <td>
                                            <x-star-rate :rate='$profile->averageRating()' count='{{ $profile->timesRated() }}' />
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Category: </th>
                                        <td>
                                            @forelse ($profile->category as $c)
                                                <a href="#"
                                                    class="bg-blue-100 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 dark:hover:bg-blue-300">
                                                    {{ $c }}
                                                </a>
                                            @empty
                                            @endforelse
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Description: </th>
                                        <td>
                                            {{ $profile->body }}
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Specialiteti: </th>
                                        <td>Pije</td>
                                    </tr>

                                    <tr>
                                        <th>Services: </th>
                                        <td>RESERVING NEEDED</td>
                                    </tr>

                                    <tr>
                                        &nbsp;
                                        <th> Social:
                                        <td class="text-lg ">
                                            @if ($profile->facebook)
                                                <a title="Facebook" href="{{ $profile->facebook }}">
                                                    <i class="fa-brands fa-facebook text-blue-700 ml-1"></i>
                                                </a>
                                            @endif
                                            @if ($profile->instagram)
                                                <a title="Instagram" href="{{ $profile->instagram }}">
                                                    <i class="fa-brands fa-instagram text-orange-400 ml-1"></i>
                                                </a>
                                            @endif
                                            @if ($profile->linkedin)
                                                <a title="Linkedin" href="{{ $profile->linkedin }}">
                                                    <i class="fa-brands fa-linkedin text-blue-700 ml-1"></i>
                                                </a>
                                            @endif
                                            @if ($profile->twitter)
                                                <a title="Twitter" href="{{ $profile->twitter }}">
                                                    <i class="fa-brands fa-twitter text-[#00acee] ml-1"></i>
                                                </a>
                                            @endif
                                        </td>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th>Gallery: </th>
                                        <td>
                                            <a href="{{ route('profile.album.show', ['profile' => $profile->slug]) }}"
                                                class="text-blue-500">
                                                {{ __('View Gallery') }}
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </article>
                    </div>
                    <div id="place_aside" class="place-aside">
                        <div class="flex justify-center px-6 mt-3 mb-3 text-lg">
                            @if ($profile->user_id === auth()->id())
                                <a type="button" href="{{ route('profile.edit', ['profile' => $profile->slug]) }}"
                                    class="w-full text-center text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                                    {{ __('Edit') }}
                                </a>
                            @else
                                @auth
                                    <livewire:component.subscribe :model='$profile' />
                                @endauth
                            @endif
                        </div>

                        <aside id="map" class="related related-map">
                            <iframe
                                src="https://maps.google.com/maps?q=starlab%20prishtin&t=&z=19&ie=UTF8&iwloc=&output=embed"
                                width="100%" height="270" style="border: 1px solid rgb(255, 195, 0)" frameborder="0"
                                scrolling="no" marginheight="0" marginwidth="0">
                            </iframe>
                        </aside>

                        <ul class="actions">
                            <li>
                                <i class="fa-solid fa-location-dot"></i> &nbsp;
                                <span>
                                    {{ $profile->location }}
                                </span>
                            </li>
                        </ul>

                        <ul class="actions text-yellow-300 text-center" style="border-color: yellow;">
                            <li>
                                <livewire:component.rate :model='$profile'>
                            </li>
                        </ul>

                        <ul class="actions text-red-500 text-center" style="border-color: red;">
                            <li>
                                <livewire:profile.report :model='$profile' />
                            </li>
                        </ul>

                        {{-- <ul class="actions">
                                <li>
                                    <i class="fa-solid fa-phone"></i> &nbsp;
                                    <span>
                                        <a href="tel:{{ $profile->phone }}">{{ $profile->phone }}</a>
                                    </span>
                                </li>
                            </ul> --}}
                    </div>
                </div>
            </div>
            <div class="c overflow-hidde">
                <div class="container mx-auto">
                    <div class="container mx-auto flex flex-wrap place-content-between">
                        <h3 class="mb-4 text-lg font-semibold text-gray-900"> ACTIVE EVENT </h3>
                        @if ($profile->events->count() > 5)
                            <a href="#" class="text-gray-700 text-sm font-thin mb-2 pr-4  mt-1 justify-self-end">
                                View All >
                            </a>
                        @endif
                    </div>
                </div>
                {{-- {{-- <div class="mt-6 lg:space-y-0 flex"> --}}
                {{-- <x-event-section href="{{ route('event.show') }}" text='Incoming Events'> --}}
                <div class="mt-6 flex flex-wrap">
                    @forelse ($profile->events->take(4) as $event)
                        <x-card-event title="{{ $event->title }}" start_date="{{ $event->start_date }}"
                            end_date="{{ $event->end_date }}" location="Prishtin"
                            href="{{ route('event.single', ['event' => $event->slug]) }}"
                            price="{{ $event->price }}" />
                    @empty
                        <strong><span class="text-center text-red-500">No Active Events </span></strong>
                    @endforelse
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>
    <div class="c">
        <livewire:component.get-rate :model='$profile'>
    </div>
</x-app-layout>
