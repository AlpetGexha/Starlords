<div x-show="selectedRows.length" class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 x-html="selectedRows.length + ' rows are selected'" class="text-lg leading-6 font-medium text-gray-900"></h3>
        <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p></p>
        </div>
        <div class="mt-5">
            <button type="submit" x-on:click="$wire.deleteSelectIteams(selectedRows)"
                @colum-deleted.window="unSelectAll()" type="button"
                class="inline-flex items-center justify-center px-5 py-2.5 mr-2 mb-2 border border-transparent font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:text-sm">
                {{ __('Delete Rows') }}
            </button>
            <button type="submit" x-on:click="unSelectAll()" type="button"
                class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 border-transparent font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __('Un Select') }}
            </button>
            <button type="submit" x-on:click="selectAllHere()" type="button"
                class="text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 border-transparent font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                {{ __('Select All') }}
            </button>
        </div>
    </div>
</div>
