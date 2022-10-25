<x-card x-cloak>
    <div class="flex flex-wrap -mx-2 space-y-4 md:space-y-0">
        <div class="w-full px-2 md:w-1/2">
            <x-input label="Name" wire:model.defer='name' />
        </div>
        <div class="w-full px-2 md:w-1/2">
            <x-input label="Position" wire:model.defer='position' />
        </div>
    </div>

    <div class="mt-5">
        <x-progres-file preview wire:model='photo' />
        <x-jet-input-error for="photo" />
    </div>

    <div class="mt-5">
        <x-input type="url" icon="link" label="github" wire:model.defer='github' />
    </div>

    <div class="mt-5">
        <x-input type="url" icon="link" label="twitter" wire:model.defer='twitter' />
    </div>

    <div class="mt-5">
        <x-input type="url" icon="link" label="linkedin" wire:model.defer='linkedin' />
    </div>

    <div class="flex mt-5">
        <x-button class="mr-5" wire:click='store()' purple label="Purple" label="Create" />
        <x-button wire:click='store()' purple label="Create Another" />
    </div>
</x-card>
