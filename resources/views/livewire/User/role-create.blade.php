@php
$permissions = \Spatie\Permission\Models\Permission::with('roles')->select('id', 'name', 'guard_name')->get();
@endphp
<x-card>
    <div class="mt-3">
        <x-input type="text" label="Name" wire:model.defer='name' />
    </div>
    <div class="mt-4">
        <div class="grid grid-cols-4 gap-4">
            @foreach ($permissions as $permission)
                <div>
                    <x-checkbox wire:model.defer='permissions' id="permissions-{{ $permission->name }}"
                        value="{{ $permission->id }}" label="{{ $permission->name }}" />
                </div>
            @endforeach
        </div>
    </div>

    <div class="mt-4">
        <x-button purple wire:click.prevent="store()"> {{ __('Create') }} </x-button>
    </div>
</x-card>
