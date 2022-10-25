<x-card>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="mt-2">
        <x-input wire:model.defer='title' label="Title" placeholder="Event Title" />
    </div>

    <div class="mt-4">
        <x-textarea wire:model.defer='body' class="resize-none" label="Description" placeholder="Description" />
    </div>

    <div class="mt-4">
        <x-select wire:model.defer="categorys" label="Category" placeholder="Select Event Category" multiselect>
            @foreach ($categoryss as $category)
                <x-select.option label="{{ $category->title }}" value="{{ $category->id }}" />
            @endforeach
        </x-select>
    </div>

    <div class="mt-4">
        <x-multi-tag wire:model.defer='tags' />
    </div>

    {{-- check if user have profile --}}
    @if (auth()->user()->profile)
        <div class="mt-4">
            <x-select label="profile" placeholder="Select Event Category" wire:model.defer="profile_id">
                @forelse ($profiles as $profile)
                    <x-select.option label="{{ $profile->name }}" value="{{ $profile->id }}" />
                @empty
                @endforelse
            </x-select>
        </div>
    @endif
    <div class="mt-4">
        <x-inputs.currency label="Price" placeholder='Price' prefix="€" thousands="." decimal=","
            wire:model.defer="price" />
    </div>

    <div class="grid grid-cols-6 gap-6">
        <div class="col-span-6 sm:col-span-3">
            <div class="mt-4">
                <x-datetime-picker label="Start Date" placeholder="Start Date" wire:model.defer="start_date"
                    :min="now()" />
            </div>
        </div>

        <div class="col-span-6 sm:col-span-3">
            <div class="mt-4">
                <x-datetime-picker label="End Date" placeholder="End Date" wire:model.defer="end_date"
                    :min="now()" />
            </div>

        </div>
    </div>

    <div class="mt-4">
        <x-input wire:model.defer='location' label='location' />
    </div>

    <div class="sm:col-span-6 mt-4">
        <x-progres-file-pro wire:model.defer='photo' preview width='170' height='170' />
        <x-jet-input-error for='photo' />
    </div>

    <div class="mt-4">
        <x-buttonn wire:click='store()' class="w-full">
            {{ __('Create Event') }}
        </x-buttonn>
    </div>

</x-card>
