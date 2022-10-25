<x-card>
    <div class="">
        <x-input label="Title" wire:model.defer='title' />
    </div>

    <div class="mt-5">
        <x-textarea label="Body" wire:model.defer='body' />
    </div>

    <div class="mt-5">
        <x-progres-file preview wire:model='photo' />
        <x-jet-input-error for="photo" />
    </div>

    <div class="mt-5">
        <x-button purple label="Create" wire:click.prevent="store()" />
    </div>
</x-card>
