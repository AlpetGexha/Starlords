<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="datatables()" x-cloak>
    @include('components.checkboxtable')
    <div class="mb-4 flex justify-between items-center" x-data="open: false">
        <div class="flex-1 pr-4">
            <div class="relative md:w-1/2">
                <x-input type="search" class="font-medium shadow pr-4 rounded-lg" icon="search" placeholder="Search..."
                    wire:model='search' />
            </div>
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class='px-4 py-3'>#
                        <span wire:click='sortBy("id")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'id' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    </th>
                    <th class='px-4 py-3'>Type</th>
                    <th class='px-4 py-3'>Message</th>
                    <th class='px-4 py-3'>Reviewd</th>

                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($feedbacks as $feedback)
                    <tr class="text-gray-700 dark:text-gray-400">

                        <td class="px-4 py-3 text-sm" width='6%'>
                            {{ ($feedbacks->currentPage() - 1) * $feedbacks->perPage() + $loop->iteration }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $feedback->type }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $feedback->message }}
                        </td>

                        <td class='px-4 py-3 text-sm' width='6%'>
                            {{ $feedback->reviewed }}
                        </td>

                        <td class="px-4 py-3" width='10%'>
                            <div class="flex items-center space-x-4 text-sm">

                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        @can('contact_delete')
                                            <x-dropdown.item wire:click.prevent="delete({{ $feedback->id }})" icon="trash"
                                                label="Delete" />
                                        @endcan

                                        @can('admin_show')
                                            <x-dropdown.item wire:click.prevent="edit({{ $feedback->id }})" icon="eye"
                                                label="Show" />
                                        @endcan
                                    </x-dropdown.header>
                                </x-dropdown>

                                {{-- flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <span class="py-4 text-red-500 uppercase text-lg">No data found</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div
        class="flex justify-between px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            per page:
            <select wire:model="paginate_page" id="countries"
                classs="w-1/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($page_numer as $page)
                    <option value="{{ $page }}" {{ $page_numer[0] ? 'selected' : '' }}>
                        {{ $page }}
                    </option>
                @endforeach
            </select>
        </span>
        <span class="col-span-2"></span>
        {{ $feedbacks->links() }}
    </div>

    <x-jet-dialog-modal wire:model="openModelName">
        <x-slot name="title">
            {{ __('Show Feedback') }}
        </x-slot>

        <x-slot name="content">

            <div>
                <p>{{ __('Type: ') }} <b> {{ $type }} </b> </p>
            </div>

            <div class="mt-4">
                <p>{{ __('Reviewed: ') }} <b> {{ $reviewed }} </b> </p>
            </div>

            <div class="mt-4">
                <p>{{ __('Message: ') }} <br><b class="ml-5"> {{ $message }} </b> </p>
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModelName')" wire:loading.attr="disabled">
                {{ __('Close') }}
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
