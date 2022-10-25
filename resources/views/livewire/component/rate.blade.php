<div class="text-start">
    @auth
        <button wire:click.prevent='open()' class="text-yellow-300 text-center">
            <i class="fa-solid fa-star"></i>&nbsp;
            {{ __('Review') }}
        </button>
    @else
        <a href="{{ route('login') }}" class="text-yellow-300 text-center">
            <i class="fa-solid fa-star"></i>&nbsp;
            {{ __('Review') }}
        </a>

    @endauth


    <x-jet-dialog-modal wire:model="openRateModal">
        <x-slot name="title">
            <h5 class="text-red-500 text-3x1">{{ __('Review') }}</h5>
        </x-slot>

        <x-slot name="content">
            <div class="my-4">
                <div x-data="{ temp: 0, orig: null }" @click="orig = temp" class="flex cursor-pointer text-4xl">
                    <template x-if="orig != null">
                        <span class="text-gray-400 hover:text-gray-700" @mouseenter="temp = null"
                            @mouseleave="temp = orig">⨯</span>
                    </template>

                    <template x-for="item in [1, 2, 3, 4, 5]">
                        <button type="submit" class="text-gray-300" @mouseenter="temp = item" @mouseleave="temp = orig"
                            @click="$wire.setRating(item)" :class="{ 'text-yellow-300': (temp >= item) }">★</button>
                    </template>
                </div>
                <x-jet-input-error for="rating" class="mt-2" />

                <x-jet-label class="mb-3" for='comment' value='Why Do u Thing about this: ' />
                <textarea name="comment" wire:model.defer='comment'
                    class=" {{ $errors->has('comment') ? 'border-red-500' : '' }} resize-none block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    id="comment" cols="50" rows="10" placeholder="Type a comment "></textarea>
                <p class="text-sm text-gray-500 uppercase">
                    <b>{{ __('U can REPORT only one time!') }}</b> {{ __('Make sure u report is great') }}
                </p>
                <x-jet-input-error for="comment" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openRateModal')" wire:loading.attr="disabled">
                {{ __('Cancle') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click="create()" wire:loading.attr="disabled">
                <i class="fa-solid fa-star"></i>&nbsp; &nbsp;
                {{ __('Review') }}
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
