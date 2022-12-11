<x-app-layout>
    <div class="flex items-center bg-cover  md:py-10 md:px-16 hero-section"
        style="background-image:url('images/pexels.jpg');">
        <form class=" container mx-auto  p-6 md:p-10 rounded w-full  ">
            <h1 class="max-w mb-4 text-4xl font-mono uppercase overline not-italic hover:italic tracking-tight leading-none md:text-5xl xl:text-6xl text-white">
                {{ $setting->home_words }}
            </h1>
            <livewire:event.search />
        </form>
    </div>

    <x-header-section />

    <div class="mx-auto">
        <x-event-section href="{{ route('event.show') }}" text='Incoming Events'>
            {{-- @dd($events) --}}
            <livewire:event.incoming-events />

        </x-event-section>
    </div>

    <livewire:category.show />

    <x-partnerships :sponzors='$sponzors' />

</x-app-layout>
