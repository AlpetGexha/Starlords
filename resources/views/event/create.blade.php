<x-app-layout>
    <x-slot name="header">
        <i class="fa-solid fa-ticket fa-lg fa-fw mr-2"></i>
        {{ __('Create Event') }}
    </x-slot>
    <div class="my-5">
        <div class="max-w-[800px] mx-auto pt-1 pb-12 px-4 lg:pb-16">
            <div class="space-y-6">
                <div>
                    <h1 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('Create Event') }}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('') }}
                    </p>
                </div>
                <livewire:event.create />
            </div>
        </div>
    </div>

</x-app-layout>
