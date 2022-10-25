<x-app-layout>

    <x-slot name="header">
        <i class="fa fa-user-plus fa-lg fa-fw mr-2"></i>
        {{ __('Edit Organization') }} {{ $profile->name }}
    </x-slot>

    <div class="my-5">
        <div class="max-w-[800px] mx-auto pt-1 pb-12 px-4 lg:pb-16">
            <div class="space-y-6">
                <livewire:profile.edit :model='$profile' />
            </div>
        </div>
    </div>
</x-app-layout>
