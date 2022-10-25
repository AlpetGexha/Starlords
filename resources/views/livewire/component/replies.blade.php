<div>
    <form wire:submit.prevent='create()'>
        <div class="mb-4 w-full bg-gray-50 rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600">
            <div class="py-2 px-4 bg-white rounded-t-lg dark:bg-gray-800">
                <label for="comment" class="sr-only">Your comment</label>
                <textarea id="comment" rows="4" wire:model.defer="reply"
                    class="{{ $errors->has('reply') }}px-0 w-full text-sm resize-none text-gray-900 bg-white border-0 dark:bg-gray-800 focus:ring-0 dark:text-white dark:placeholder-gray-400"
                    placeholder="Write a comment..." required="">
            </textarea>
            </div>
            <div class="flex justify-end items-center py-2 px-3 border-t dark:border-gray-600">
                <div class="flex pl-0 space-x-1 sm:pl-2">
                    @auth
                        <x-button type="submit"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-cente rounded-lg focus:ring-4">
                            {{ __('Reply') }}
                        </x-button>
                    @else
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center py-2.5 px-4 text-xs font-medium text-center rounded-lg ml-3 justify-center  border border-transparent shadow-sm  text-white bg-sky-500 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500">
                            {{ __('Reply') }}
                        </a>
                    @endauth

                </div>
            </div>
        </div>
    </form>
</div>
