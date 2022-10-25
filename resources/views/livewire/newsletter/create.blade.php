<form class="mt-4 sm:flex sm:max-w-md" wire:submit.prevent='store()'>
    <label for="email-address" class="sr-only">{{ __('Email address') }}</label>
    <input type="email" wire:model.defer='email' autocomplete="email" required
        class="appearance-none min-w-0 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:placeholder-gray-400"
        placeholder="Enter your email">
    <x-jet-input-error for="email" />
    <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
        <x-buttonn type="submit">
            {{ __('Subscribe') }}
        </x-buttonn>
    </div>
</form>
