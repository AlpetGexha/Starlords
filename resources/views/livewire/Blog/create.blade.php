<x-card>
    <div class="">
        <x-input label="Title" wire:model.defer='title' />
    </div>

    <x-tinymce wire:model='body' />

    <div class="mt-5">
        <x-multi-tag wire:model.defer='tags' />
    </div>

    <div class="mt-5">
        {{-- <x-progres-file preview wire:model='photo' /> --}}
        <x-progres-file-pro preview wire:model='photo' />
        <x-jet-input-error for="photo" />
    </div>

    <div class="mt-5">
        <div class="flex justify-end">
            <x-button purple label="Create" wire:click.prevent="store()" />
        </div>
    </div>

</x-card>
