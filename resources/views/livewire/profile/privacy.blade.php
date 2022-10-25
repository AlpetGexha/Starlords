<x-jet-form-section submit="updatePrivacy()">
    <x-slot name="title">
        {{ __('Change Visible') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Change profile privacy') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-native-select label="Select Status" wire:model="profile_privacy">
                <option value="1" {{ auth()->user()->is_public === 1 ? 'checked' : '' }}>Public</option>
                <option value="0" {{ auth()->user()->is_public === 0 ? 'checked' : '' }}>Privat</option>
            </x-native-select>
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button>
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
