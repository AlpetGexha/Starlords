<div class="">

    <button wire:click.prevent='cleanOutput()'>
        {{ __('Clear output') }}
    </button>

    <x-terminal>
        {{ $backup_time ? $backup_time . ' MS' : '' }}
        <div class="flex">
            <div class=" p-3 text-center" wire:loading>
                <p class="flex">
                    <svg class="animate-spin h-5 w-5 mr-3 bg-[#00FF00]" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">\
                        <path
                            d="M304 48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zm0 416c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM48 304c26.5 0 48-21.5 48-48s-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48zm464-48c0-26.5-21.5-48-48-48s-48 21.5-48 48s21.5 48 48 48s48-21.5 48-48zM142.9 437c18.7-18.7 18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zm0-294.2c18.7-18.7 18.7-49.1 0-67.9S93.7 56.2 75 75s-18.7 49.1 0 67.9s49.1 18.7 67.9 0zM369.1 437c18.7 18.7 49.1 18.7 67.9 0s18.7-49.1 0-67.9s-49.1-18.7-67.9 0s-18.7 49.1 0 67.9z" />
                    </svg>
                    {{ __('Plz wait a little...') }}
                </p>
            </div>
        </div>

        @if (session()->has('output'))
            <p class="p-3">
                {{ session('output') }}
            </p>
        @endif
    </x-terminal>

    <div class="grid grid-cols-3 gap-3 mb-5">
        <div>
            <x-card>
                <button wire:click.prevent='backupAll()'>
                    {{ __('Backup All Project') }}
                </button>
            </x-card>
        </div>

        <div>
            <x-card>
                <button wire:click='backupOnlyDB()'>
                    {{ __('Backup only Database') }}
                </button>
            </x-card>
        </div>

        <div>
            <x-card>
                <button wire:click.prevent='backupOnlyFile()'>
                    {{ __('Backup only Files') }}
                </button>
            </x-card>
        </div>

        <div>
            <x-card>
                <button wire:click.prevent='backupMonitor()'>
                    {{ __('Check Backup Monitorate') }}
                </button>
            </x-card>
        </div>

        <div>
            <x-card>
                <button wire:click.prevent='backupList()'>
                    {{ __('Check Backup List') }}
                </button>
            </x-card>
        </div>

        <div>
            <x-card>
                <button wire:click.prevent='backupDelete()'>
                    {{ __('Delete all Backup') }}
                </button>
            </x-card>
        </div>

    </div>

    <div class="w-full overflow-x-auto ">
        <table class="w-full whitespace-no-wrap my-12">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3" width='10%'>Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($files as $file)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ substr($file, strrpos($file, '/') + 1) }}
                        </td>
                        <td class="px-4 py-3">
                            <x-button red wire:click='unsetFile({{ $file }})'>
                                {{ __('Delete') }}
                            </x-button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <span class="text-red-500 uppercase text-lg">{{ __('No Backup found') }}</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
