<div>
    <div class="sm:col-span-6 mt-4">
        <x-progres-file-pro wire:model.defer='photos' preview multiple width='170' height='170' />
        <x-jet-input-error for='photos' />
    </div>
    <x-buttonn wire:click.prevent='store()' class="mt-4">
        {{ __('Upload') }}
    </x-buttonn>
</div>
