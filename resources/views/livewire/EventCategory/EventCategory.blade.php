<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="datatables()" x-cloak>

    @include('components.checkboxtable')
    <div class="mb-4 flex justify-between items-center">
        <div class="flex-1 pr-4">
            <div class="relative md:w-1/2">
                <x-input type="search" class="font-medium shadow pr-4 rounded-lg" icon="search" placeholder="Search..."
                    wire:model='search' />
            </div>
        </div>
        <div>
            <div>
                <x-button purple href="{{ route('admin.catgory.create') }}">
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
                    <th width='1%' scope="col">
                        <x-checkbox id="checkbox" x-on:click="selectAllCheckbox($event)" />
                    </th>
                    <th class='px-4 py-3'>#</th>
                    <th class='px-4 py-3'>Image</th>
                    <th class='px-4 py-3'>Name</th>
                    <th class='px-4 py-3'>Body</th>

                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($categorys as $catgory)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td>
                            <x-checkbox class="rowCheckbox" id="checkbox"
                                x-on:click="getRowDetail($event, {{ $catgory->id }})" value="{{ $catgory->id }}" />
                        </td>

                        <td class="px-4 py-3">
                            {{ ($categorys->currentPage() - 1) * $categorys->perPage() + $loop->iteration }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img class="ring- object-cover w-full h-full rounded-full"
                                    src="{{ $catgory->getMedia('event_category')->first()? $catgory->getMedia('event_category')->first()->getUrl(): config('app.no_file') }}"
                                    alt="{{ $catgory->name }}">
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                </div>
                            </div>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <livewire:component.inline :model="'\App\Models\EventCategory'" :entity="$catgory" :field="'title'"
                                :key="'event_categories' . $catgory->id" :slug='true' />
                        </td>
                        <td class='px-4 py-3 text-sm'>
                            <livewire:component.inline :model="'\App\Models\EventCategory'" :entity="$catgory" :field="'body'"
                                :key="'event_categories' . $catgory->id" />
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">

                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        @can('category_delete')
                                            <x-dropdown.item wire:click.prevent="delete({{ $catgory->id }})" icon="trash" label="Delete" />
                                        @endcan
                                        <x-dropdown.item icon="pencil" label="Edit" />
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
        class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
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
        <!-- Pagination -->
        <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
            {{ $categorys->links() }}
        </span>
    </div>

    <x-jet-dialog-modal wire:model="openModelName">
        <x-slot name="title">
            {{ __('Create Category') }}
        </x-slot>

        <x-slot name="content">
            <div class="">
                <x-input type="text" label="Name" wire:model.defer="name" />
                <x-jet-input-error for="name" class="mt-2" />
            </div>

            <div class="mt-5">
                <x-textarea label="Body" wire:model.defer="body" />
                <x-jet-input-error for="photo" class="mt-2" />
            </div>

            <div class="mt-5">
                <x-progres-file wire:model='photo' />
                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModelName')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click.prevent="store()">
                {{ __('Create') }}
            </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
