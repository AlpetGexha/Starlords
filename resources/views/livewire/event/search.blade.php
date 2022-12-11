<div wire:init='loadCategory' class="flex flex-wrap items-end -mx-3" x-data="{
    category: [],
    input: ''
}">
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-password">
            {{ __('Search for event') }}
        </label>
        <x-input x-model='input' wire:model='search' placeholder="Search..." />
    </div>
    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
        <label class="block uppercase tracking-wide text-white text-xs font-bold mb-2" for="grid-state">
            {{ __('Type') }}
        </label>
        <div class="relative">
            <x-select multiselect wire:model.defer='category'>
                @forelse ($categorys as $category)
                    <x-select.option label="{{ $category->title }}" value="{{ $category->id }}" />
               @empty
                    <x-select.option label="LOADING..." />
                @endforelse
            </x-select>

        </div>
    </div>
    <div class="w-full md:w-1/3 px-3 md:mb-0">
        <button wire:click.prevent='search()'
            class="font-bold leading-tight bg-red hover:bg-red-light border border-red hover:border-red-light hover:border-gray-400 hover:drop-shadow-2xl w-full text-white uppercase tracking-wide py-3 px-4 rounded">Search</button>
    </div>
</div>
