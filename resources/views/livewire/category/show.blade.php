<div class="bg-gray-100 pl-8 ">
    <div class="container mx-auto pt-15 ">
        <div class="max-w-2xl mx-auto py-10 lg:max-w-none ">
            <h2
                class="focus:outline-none xl:text-3xl md:text-3xl text-xl dark:text-white text-center text-cyan-500 font-extrabold mb-5 pt-4">
                {{ __('Explore Events By Category') }}
            </h2>
            <br>
            <div wire:init="loadCatergory" class="mt-6 lg:space-y-0 flex flex-wrap justify-center">
                @forelse($categorys as $category)
                    <div class="group relative mr-4 mt-0 mb-4">
                        <div
                            class="relative h-44 w-48 bg-white rounded-lg overflow-hidden group-hover:opacity-75 sm:aspect-w-2 sm:aspect-h-1 lg:aspect-w-1 lg:aspect-h-1">
                            <img src="{{ $category->getMedia('event_category')->first()? $category->getMedia('event_category')->first()->getUrl(): config('app.no_file') }}"
                                alt="{{ $category->title }}" class="w-full h-full object-center object-cover">
                        </div>
                        <h3 class="text-base pt-2 font-semibold text-gray-900">
                            <a href="{{ route('event.show') }}?category[0]={{ $category->id }}">
                                <span class="absolute inset-0"></span>
                                {{ $category->title }}
                            </a>
                        </h3>
                        <p class="mt-2 text-sm text-gray-500"></p>
                    </div>
                @empty
                    <strong class="text-center text-red-500"><span>No Category</span></strong>
                @endforelse
            </div>
        </div>
    </div>
</div>
