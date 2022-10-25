<div>
    <x-input wire:model.defer='name' label='Partnership' />

    <div class="mt-5">
        <x-input wire:model.defer='url' label='Url' />
    </div>

    <div class="mt-5">
        <x-input wire:model.defer='url_image' label='Url Image' />
    </div>

    <div class="flex justify-end mt-5">
        <x-button purple label="Create" wire:click.prevent="store()" />
    </div>

</div>
