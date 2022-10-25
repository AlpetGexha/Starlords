<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="datatables()" x-cloak>
    @include('components.checkboxtable')
    <div class="mb-4 flex justify-between items-center">
        <div class="flex-1 pr-4">
            <div class="relative md:w-1/2">
                <x-input wire:model='search' type="search" class="font-medium shadow pr-4 rounded-lg" icon="search"
                    placeholder="Search..." />
            </div>
        </div>
        <div>
            <div>
                <x-button purple>
                    {{ __('Create') }}
                </x-button>
            </div>
        </div>
    </div>
    <div class="w-full overflow-x-auto">
        <table class="w-full whitespace-no-wrap">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    {{-- <th width='1%' scope="col">
                        <x-checkbox id="checkbox" x-on:click="selectAllCheckbox($event)" />
                    </th> --}}
                    <th class='px-4 py-3'>#</th>
                    <th class='px-4 py-3' width='10%' scope="col">Group
                        <span wire:click='sortBy("group")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'group' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    <th class='px-4 py-3'>Key</th>
                    <th class='px-4 py-3'>Payload</th>

                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($settings as $setting)
                    <tr class="text-gray-700 dark:text-gray-400">
                        {{-- <td>
                            <x-checkbox class="rowCheckbox" id="checkbox"
                                x-on:click="getRowDetail($event, {{ $catgory->id }})" value="{{ $catgory->id }}" />
                        </td> --}}

                        <td class="px-4 py-3">
                            {{ ($settings->currentPage() - 1) * $settings->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $setting->group }}
                        </td>

                        <td class="px-4 py-3">
                            {{ $setting->name ? $setting->name : 'Empty' }}
                        </td>

                        <td class="px-4 py-3">
                            {{ str()->removeFirstLast($setting->payload) }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">

                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        <x-dropdown.item wire:click.prevent="delete({{ $setting->id }})" icon="trash"
                                            label="Delete" />
                                        <x-dropdown.item wire:click.prevent="edit({{ $setting->id }})" icon="pencil"
                                            label="Edit" />
                                    </x-dropdown.header>
                                </x-dropdown>

                                {{-- flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            <span class="py-4 text-red-500 uppercase text-lg">{{ __('No data found') }}</span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center col-span-3">
            {{ __('per page:') }}
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
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            {{ $settings->links() }}
        </span>
    </div>

    <x-jet-dialog-modal wire:model="openModal">
        <x-slot name="title">
            {{ __('Change Setting') }}
        </x-slot>

        <x-slot name="content">
            <label for="Nmae">Grup Name:</label>
            <p>{{ $name }}</p>

            <label for="Nmae">Key Name:</label>
            <p>{{ $name }}</p>

            <div class="mt-4">
                <x-input wire:model.defer='setting_key' />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click.prevent="update()">
                {{ __('Update') }}
            </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
