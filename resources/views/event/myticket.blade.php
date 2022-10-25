<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-ticket fa-lg fa-fw mr-2"></i>
        {{ __('My Ticket') }}
    </x-slot>

    <div class="bg-gray-100 py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul role="list" class="divide-y divide-gray-200">
                    @forelse ($profiles as $profile)
                        <li>
                            <a href="{{ route('profile.single', ['profile' => $profile->slug]) }}"
                                class="block hover:bg-gray-50">
                                <div class="flex items-center px-4 py-4 sm:px-6">
                                    <div class="min-w-0 flex-1 flex items-center">
                                        <div class="flex-shrink-0">
                                            <img class="h-[140px] w-[140px] rounded-full"
                                                src="{{ $profile->getImage() }}" alt="{{ $profile->name }}" />
                                        </div>
                                        <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                            <div>
                                                <p class="text-sm font-medium text-indigo-600 truncate">
                                                    {{-- {{ $profile->user }} --}}
                                                </p>
                                                <p class="mt-2 flex items-center text-sm text-black-500">
                                                    <span class="truncate">
                                                        {{ $profile->name }}
                                                    </span>
                                                </p>
                                            </div>
                                            <div class="hidden md:block">
                                                <div>
                                                    <p class="text-sm text-gray-900">
                                                        {{--  --}}
                                                    </p>
                                                    <p class="mt-2 flex items-center text-sm text-gray-500">
                                                        {{--  --}}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: solid/chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </li>

                        @forelse ($profile->tickets as $ticket)
                            @for ($i = 0; $i < $ticket->quantity; $i++)
                                <li>
                                    <a href="{{ route('event.single', ['event' => $ticket->event->slug]) }}"
                                        class="block hover:bg-gray-50">
                                        <div class="flex items-center px-4 py-4 sm:px-6">
                                            <div class="min-w-0 flex-1 flex items-center">
                                                <div class="flex-shrink-0">
                                                    <div class="h-[100%] w-[100%] rounded-full">
                                                        {!! QrCode::generate($ticket->uuid) !!}
                                                    </div>
                                                </div>
                                                <div class="min-w-0 flex-1 px-4 md:grid md:grid-cols-2 md:gap-4">
                                                    <div>
                                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                                            {{ $ticket->event->title }}
                                                        </p>
                                                        <p class="mt-2 flex items-center text-sm text-gray-500">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"  viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                                <path stroke-linecap="round" stroke-linejoin="round"  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                                            </svg>
                                                            <span class="truncate">
                                                                {{ $ticket->event->price }} &euro;
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="hidden md:block">
                                                        <div>
                                                            <p class="text-sm text-gray-900">
                                                                {{ __('Buy Time: ') }} &nbsp;
                                                                <!-- space -->
                                                                <time>{{ str()->getFullDate($ticket->created_at) }}</time>
                                                            </p>
                                                            <p class="mt-2 flex items-center text-sm text-gray-500">
                                                                {{-- check if data now its higer than end_date --}}
                                                                @if (now() > $ticket->event->end_date)
                                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-red-400" x-description="Heroicon name: solid/check-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span class="truncate">{{ __('Expired') }}</span>
                                                                @else
                                                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-green-400" x-description="Heroicon name: solid/check-circle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                    <span class="truncate">{{ __('Active') }}</span>
                                                                @endif
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <svg class="h-5 w-5 text-gray-400" x-description="Heroicon name: solid/chevron-right" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endfor
                        @empty
                            <strong class="text-center">
                                <span>{{ __('No tickets found') }}
                                    <a class="text-blue-500" href="{{ route('event.show') }}">
                                        {{ __('Go Buy') }}
                                    </a>
                                </span>
                            </strong>
                        @endforelse
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
