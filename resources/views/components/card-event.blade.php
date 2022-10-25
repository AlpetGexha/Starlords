@props(['event'])
<!-- Start Card -->
<div class="w-full sm:w-1/2 md:w-1/2 xl:w-1/4 pr-4 pb-4 justify-start">
    <a href="{{ route('event.single', ['event' => $event->slug]) }}"
        class="c-card block bg-white shadow-md hover:shadow-xl rounded-lg overflow-hidden">
        <div class="relative pb-48 overflow-hidden">
            <img class="absolute inset-0 h-full w-full object-cover hover:scale-105	" loading="lazy"
                src="{{ $event->getMedia('event')->first()? $event->getMedia('event')->first()->getUrl(): config('app.no_file_event') }}"
                alt="{{ $event->title }}">
        </div>
        <div class="p-4">
            @forelse ($event->category as $e)
                <span
                    class="inline-block px-2 py-1 leading-none bg-orange-200 text-orange-800 rounded-full font-semibold uppercase tracking-wide text-xs">
                    {{ $e->title }}
                </span>
            @empty
            @endforelse

            <h2 class="mt-2 mb-2  font-bold truncate">{{ $event->title }}</h2>
            <p class="text-sm truncate ">
                {{ $event->body }}
            </p>
            <div class="mt-3 flex items-center">
                @if (isset($event->price))
                    <div class="border-b border-gray-300 mr-0 "></div>
                    <span class="text-sm font-semibold"></span>&nbsp;<span
                        class="font-bold text-xl">{{ $event->price }}</span>&nbsp;<span
                        class="text-sm font-semibold">€</span>
                @endif
            </div>
        </div>
        <div class="p-4 border-t border-b text-xs text-gray-700">
            <span class="flex items-center mb-1">
                <i class="far fa-clock fa-fw mr-2 text-gray-900"></i> {{-- {{ $event->start_date }} - {{ $event->end_date }} --}}
                {{ \Carbon\Carbon::parse($event->start_date)->isoFormat('MMM Do YYYY h:mm') }} -
                {{ \Carbon\Carbon::parse($event->end_date)->isoFormat('MMM Do YYYY h:mm') }}
            </span>
            <span class="flex items-center truncate">
                <i class="fa-solid fa-location-dot fa-fw text-gray-900 mr-2"></i>
                <span class="truncate">{{ $event->location }}</span>
            </span>
        </div>
        <div class="p-4 flex items-center text-sm text-gray-600 hover:bg-gray-100"><span class="ml-2">Buy</span></div>
    </a>
</div>
<!-- End Card -->
