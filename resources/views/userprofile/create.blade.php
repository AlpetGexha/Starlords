<x-app-layout>

    <x-slot name="header">
        <i class="fa fa-user-plus fa-lg fa-fw mr-2"></i>
        {{ __('Create Organization') }}
    </x-slot>

    <div class="my-5">
        <div class="max-w-[800px] mx-auto pt-1 pb-12 px-4 lg:pb-16">
            <div class="space-y-6">
                <div>
                    <h1 class="text-lg leading-6 font-medium text-gray-900">
                        {{ __('Create Organization') }}
                    </h1>
                    <p class="mt-1 text-sm text-gray-500">
                        {{ __('Let’s get started by filling in the information below to create your new organization.') }}
                    </p>
                </div>
              <livewire:user.profiles />
            </div>
        </div>
    </div>
</x-app-layout>
