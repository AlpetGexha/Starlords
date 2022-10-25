<div class="w-full overflow-hidden rounded-lg shadow-xs">
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
                    <th class="px-4 py-3">#
                        <span wire:click='sortBy("id")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'id' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    <th class="px-4 py-3">user_type</th>
                    <th class="px-4 py-3">user_id</th>
                    <th class="px-4 py-3">event</th>
                    <th class="px-4 py-3">auditable_type </th>
                    <th class="px-4 py-3">auditable_id </th>
                    <th class="px-4 py-3">old_values</th>
                    <th class="px-4 py-3">new_values</th>
                    <th class="px-4 py-3">url</th>
                    <th class="px-4 py-3">ip_address</th>
                    <th class="px-4 py-3">user_agent</th>
                    <th class="px-4 py-3">tags</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($audits as $audit)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            {{ ($audits->currentPage() - 1) * $audits->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->user_type }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->user_id }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->event }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->auditable_type }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->auditable_type }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->old_values }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->new_values }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->url }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->ip_address }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $audit->user_agent }}
                        </td>


                        <td class="px-4 py-3">
                            {{ $audit->tags }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <span class="text-red-500 uppercase text-lg">{{ __('No data found') }}</span>
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
                class="w-1/3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($page_numer as $page)
                    <option value="{{ $page }}" {{ $page_numer[0] ? 'selected' : '' }}>
                        {{ $page }}
                    </option>
                @endforeach
            </select>

        </span>
        <span class="col-span-2"></span>
        {{ $audits->links() }}

    </div>
</div>
