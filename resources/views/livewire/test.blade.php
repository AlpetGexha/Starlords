<div>
    <form wire:submit.prevent='store()'>
        <input type="text" wire:model.defer='name'>
        <button type="submit">Kirjo</button>
    </form>

    @forelse ($all as $a)
        {{ $a->name }}: <button wire:click.prevent='delete({{ $a->id }})'>Delete</button><br>
        <button wire:click.prevent='edit({{ $a->id }})'>Ndrysho</button> <br><br><br>
    @empty
        Nuk ka
    @endforelse




    <x-jet-dialog-modal wire:model="openModelName">
        <x-slot name="title">
            Përditeso
        </x-slot>

        <x-slot name="content">
            <x-input wire:model.defer='name' label="Name    "
                class="rounded-lg shadow focus:outline-none focus:shadow-outline"
                type="name" required autofocus />
            @error('name')
                <br><strong><span style="color: red;">{{ $message }} </span></strong>
            @enderror
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModelName')" wire:loading.attr="disabled">
                Anulo
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:keydown.enter="update()" wire:loading.attr="disabled">
                Ndrysho
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
