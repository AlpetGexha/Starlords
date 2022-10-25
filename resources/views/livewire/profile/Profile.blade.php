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
                    <th width='1%' scope="col">
                        <x-checkbox id="checkbox" x-on:click="selectAllCheckbox($event)" />
                    </th>
                    <th class="px-4 py-3">Image</th>
                    <th class='px-4 py-3'>Owner</th>
                    <th class='px-4 py-3'>name</th>
                    <th class='px-4 py-3'>Description</th>
                    <th class='px-4 py-3'>email</th>
                    <th class='px-4 py-3'>phone</th>
                    <th class='px-4 py-3'>category</th>
                    <th class='px-4 py-3'>facebook</th>
                    <th class='px-4 py-3'>twitter</th>
                    <th class='px-4 py-3'>instagram</th>
                    <th class='px-4 py-3'>linkedin</th>
                    <th class='px-4 py-3'>website</th>
                    <th class='px-4 py-3'>link</th>
                    <th class='px-4 py-3'>location</th>
                    <th class='px-4 py-3'>address</th>
                    <th class='px-4 py-3'>is_active</th>
                    <th class='px-4 py-3'>is_verified</th>

                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($all as $Profile)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td>
                            <x-checkbox class="rowCheckbox" id="checkbox"
                                x-on:click="getRowDetail($event, {{ $Profile->id }})" value="{{ $Profile->id }}" />
                        </td>

                        <td>
                            <img width="100px" height="100px"
                                src="{{ $Profile->getMedia('event')->first()? $Profile->getMedia('event')->first()->getUrl(): config('app.no_file') }}"
                                alt="{{ $Profile->name }}">
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $Profile->user->username() }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a
                                href="{{ route('profile.single', ['profile' => $Profile->slug]) }}">{{ $Profile->name }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $Profile->body }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $Profile->email }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $Profile->phone }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{--
                            @forelse ($Profile->category as $category)
                                {{ $category }}
                            @empty
                                <span>No category found</span>
                            @endforelse
                            --}}

                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ $Profile->facebook }}">{{ Str::afterLast($Profile->facebook, '/') }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ $Profile->twitter }}">{{ Str::afterLast($Profile->twitter, '/') }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ $Profile->instagram }}">{{ Str::afterLast($Profile->instagram, '/') }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ $Profile->linkedin }}">{{ Str::afterLast($Profile->linkedin, '/') }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ $Profile->website }}">{{ $Profile->website }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ $Profile->link }}">{{ $Profile->link }}</a>
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $Profile->location }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{ $Profile->address }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{-- {{ $Profile->is_active }} --}}
                            @livewire('component.status', ['model' => $Profile, 'field' => 'is_active'], key($Profile->id))
                            {{-- <livewire:component.togg> --}}
                            {{ $Profile->is_active }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            {{-- @livewire('component.status', ['model' => $Profile, 'field' => 'is_verified'], key($Profile->id)) --}}
                            {{-- <livewire:component.status :model='$Profile' field='is_verified'> --}}
                            {{ $Profile->is_verified }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">
                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        <x-dropdown.item wire:click.prevent="delete({{ $Profile->id }})"
                                            icon="trash" label="Delete" />
                                        {{-- <x-dropdown.item icon="pencil" label="Edit" /> --}}
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
        {{ $all->links() }}
    </div>
</div>
