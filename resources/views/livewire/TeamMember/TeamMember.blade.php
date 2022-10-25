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
            <div class="rounded-lg flex">
                @can('team_create')
                    <x-button purple href="{{ route('admin.team.create') }}">
                        {{ __('Create') }}
                    </x-button>
                @endcan
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
                    <th class="px-4 py-3">#
                        <span wire:click='sortBy("id")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'id' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    <th class="px-4 py-3">Name
                        <span wire:click='sortBy("name")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'name' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    <th class="px-4 py-3">Position</th>
                    <th class="px-4 py-3">Github</th>
                    <th class="px-4 py-3">Twitter</th>
                    <th class="px-4 py-3">Linkedin</th>
                    <th class="px-4 py-3">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($staffs as $staf)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td>
                            <x-checkbox class="rowCheckbox" id="checkbox"
                                x-on:click="getRowDetail($event, {{ $staf->id }})" value="{{ $staf->id }}" />
                        </td>
                        <td class="px-4 py-3">
                            {{ ($staffs->currentPage() - 1) * $staffs->perPage() + $loop->iteration }}
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="ring- object-cover w-full h-full rounded-full"
                                        src="{{ $staf->getMedia('team')->first()? $staf->getMedia('team')->first()->getUrl(): config('app.no_file') }}"
                                        alt="{{ $staf->name }}">
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                    </div>
                                </div>
                                <div>
                                    <p class="font-semibold name">
                                        <livewire:component.inline :model="'\App\Models\TeamMember'" :entity="$staf" :field="'name'"
                                            :key="'team_members' . $staf->id" />
                                    </p>
                                    {{-- <p class="text-xs text-gray-600 dark:text-gray-400">
                                    10x Developer
                                </p> --}}
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <livewire:component.inline :model="'\App\Models\TeamMember'" :entity="$staf" :field="'position'"
                                :key="'team_members' . $staf->id" />
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $staf->github }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $staf->twitter }}
                        </td>

                        <td class="px-4 py-3 text-sm">
                            {{ $staf->linkedin }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">

                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        @can('team_delete')
                                            <x-dropdown.item wire:click.prevent="delete({{ $staf->id }})" icon="trash" label="Delete" />
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
        {{ $staffs->links() }}

    </div>
</div>
