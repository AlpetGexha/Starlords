<div>

    @auth
        <button wire:click.prevent='open()' class="text-red-500">
            <i class="fa-solid fa-flag"></i> &nbsp;
            {{ __('Report') }}
        </button>
    @else
        <a href="{{ route('login') }}" class="text-red-500">
            <i class="fa-solid fa-flag"></i> &nbsp;
            {{ __('Report') }}
        </a>
    @endauth


    <x-jet-dialog-modal wire:model="openReportModal">
        <x-slot name="title">
            <h5 class="text-red-500 text-3x1">{{ __('Report') }}</h5>
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <x-jet-label class="mb-3" for='reason' value='Why Do u Want to Report this Profile: ' />
                <textarea name="reason" wire:model.defer='reason'
                    class=" {{ $errors->has('reason') ? 'border-red-500' : '' }} resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="reason" cols="50" rows="10" placeholder="Type a reason "></textarea>
                <p class="text-sm text-gray-500 uppercase">
                    <b> U can REPORT only one time!</b> make sure u REPORT is great
                </p>
                <x-jet-input-error for="reason" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openReportModal')" wire:loading.attr="disabled">
                {{ __('Cancle') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="create()" wire:loading.attr="disabled">
                <i class="fa-solid fa-flag"></i> &nbsp;
                {{ __('Report') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
