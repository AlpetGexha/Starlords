<div wire:init='loadEvent' class="mt-6 lg:space-y-0 flex flex-wrap">
    {{-- @forelse ($events as $e)
        <x-card-event :event='$e' />
    @empty
        <strong><span class="text-red-700">{{ __('No Events') }}</span></strong>
    @endforelse --}}
    @forelse ($events as $e)
        <x-card-event :event='$e' />
    @empty
        <strong><span class="text-red-700">{{ __('No Events') }}</span></strong>
    @endforelse
</div>
