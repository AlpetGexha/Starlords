@props(['text' => '', 'href' => null])
@if (isset($text))
    <section class="overflow-hidden text-gray-700 ">
        <div class="bg-gray-100 pl-8">
            <div class="container mx-auto {{ Route::is('profile.all') ? '' : 'pt-16' }}">

                <div class="max-w-2xl mx-auto py-10 lg:max-w-none">
                    <!-- This example requires Tailwind CSS v2.0+ -->

                    <div class="-ml-4 -mt-2 flex items-center justify-between flex-wrap sm:flex-nowrap">
                        <div class="ml-4 mt-2">
                            <h3 class="text-2xl font-extrabold text-gray-900">{{ $text }}</h3>
                        </div>

                        <div class="ml-4 mt-2 flex-shrink-0">
                            @if (isset($href))
                                <a href="{{ $href }}"
                                    class="text-gray-700 text-sm font-thin mb-2  mt-1 justify-self-end">
                                    <button type="button"
                                        class="relative inline-flex items-center py-2 shadow-sm text-sm font-medium text-black ">
                                        View All >
                                    </button>
                                </a>
                            @endif
                        </div>
                    </div>
                    <div class="mt-6 lg:space-y-0 flex flex-wrap">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif


</section>
