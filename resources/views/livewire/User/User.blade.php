<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="datatables()" x-cloak>

    <div class="mb-4 flex justify-between items-center" x-data="open: false">

        <div class="flex-1 pr-4">
            <div class="relative md:w-1/2">
                <x-input type="search" class="font-medium shadow pr-4 rounded-lg" icon="search" placeholder="Search..."
                    wire:model='search' />
            </div>
        </div>
        <div>
            <div class="shadow rounded-lg flex">
                <div class="relative">
                    <button @click.prevent="open = !open"
                        class="rounded-lg inline-flex items-center bg-white hover:text-blue-500 focus:outline-none focus:shadow-outline text-gray-500 font-semibold py-2 px-2 md:px-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 md:hidden" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <path d="M5.5 5h13a1 1 0 0 1 0.5 1.5L14 12L14 19L10 16L10 12L5 6.5a1 1 0 0 1 0.5 -1.5">
                            </path>
                        </svg>
                        <span class="hidden md:block">Display</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        class="z-40 absolute top-0 right-0 w-40 bg-white rounded-lg shadow-lg mt-12 -mr-1 block py-1 overflow-hidden"
                        style="display: none;">
                        {{-- <template x-for="heading in headings">
                            <label class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
                                <div class="text-teal-600 mr-3">
                                    <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline"
                                        checked="" @click="toggleColumn(heading.key)">
                                </div>
                                <div class="select-none text-gray-700" x-text="heading.value"></div>
                            </label>
                        </template> --}}

                        {{-- <label class="flex justify-start items-center text-truncate hover:bg-gray-100 px-4 py-2">
                            <div class="text-teal-600 mr-3">
                                <input type="checkbox" class="form-checkbox focus:outline-none focus:shadow-outline"
                                    checked="" @click="toggleColumn(heading.key)">
                            </div>
                            <div class="select-none text-gray-700" x-text="heading.value">User ID</div>
                        </label> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="w-full">

        <table class="min-w-full divide-y divide-gray-200">
            @include('components.checkboxtable')
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col"
                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <x-checkbox id="checkbox" x-on:click="selectAllCheckbox($event)" />
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client
                        <span wire:click='sortBy("id")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'id' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email
                        <span wire:click='sortBy("email")' class="text-sm" style="cursor: pointer">
                            <i
                                class="fa fa-arrow-up {{ $sortBy === 'email' && $sortDirection === 'asc' ? 'fa fa-arrow-up' : 'fa fa-arrow-down' }}"></i>
                        </span>
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Provider
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Roles
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                        Created</th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3">
                            <x-checkbox class="rowCheckbox" id="checkbox"
                                x-on:click="getRowDetail($event, {{ $user->id }})" value="{{ $user->id }}" />
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center text-sm">
                                <!-- Avatar with inset shadow -->
                                <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                    <img class="ring-1 {{ $user->getActivity() ? 'ring-red-500' : 'ring-green-700' }} object-cover w-full h-full rounded-full"
                                        src="{{ $user->profile_photo_url ? $user->profile_photo_url : $user->profile_photo_path }}"
                                        alt="{{ $user->name }}" loading="lazy">
                                    <span
                                        class="bottom-0 left-[1.34rem] absolute  w-3.5 h-3.5  {{ $user->getActivity() ? 'bg-red-500' : 'bg-green-400' }} border-2 border-white dark:border-gray-800 rounded-full"></span>
                                    <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                </div>
                                <div>
                                    <p class="font-semibold flex"> {{ $user->username() }}
                                        {{ auth()->id() === $user->id ? ' (Me)' : '' }}
                                        {{ $user->is_admin ? ' (SA)' : '' }}
                                        @if ($user->is_verified === 1)
                                            <svg data-tooltip-target="tooltip-light-1" data-tooltip-style="light"
                                                xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 items-center text-center justify-center" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                            </svg>
                                            <div id="tooltip-light-1" role="tooltip"
                                                class="inline-block absolute invisible z-50 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
                                                Verified
                                                <div class="tooltip-arrow" data-popper-arrow></div>
                                        @endif
                                    </p>
                                    {{-- <p class="text-xs text-gray-600 dark:text-gray-400">
                                    10x Developer
                                </p> --}}
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            {{ $user->email }}
                        </td>
                        <td class="px-4 py-3 text-xs">
                            <span
                                class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100">
                                {{ $user->provider ? $user->provider : env('APP_NAME') }}
                            </span>
                        </td>

                        <td class="px-4 py-3 text-xs">
                            <span data-tooltip-target="tooltip-light" data-tooltip-style="light"
                                class="px-2 py-1 font-semibold leading-tight rounded-full {{ $user->banned_till ? 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' : 'text-green-700 bg-green-100  dark:bg-green-700 dark:text-green-100' }}">
                                {{ $user->banned_till ? 'BANNED' : 'GOOD' }}
                            </span>
                            <div id="tooltip-light" role="tooltip"
                                class="inline-block absolute invisible z-50 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
                                {{ $user->banned_till ? \Carbon\Carbon::parse($user->banned_till)->isoFormat('MMMM Do YYYY, h:mm:ss a') : 'Not BANNED' }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                        </td>

                        <td class="px-4 py-3 text-xs overflow-x-auto">
                            @forelse ($user->getRoleNames() as $role)
                                <span
                                    class="px-2 py-1 font-semibold leading-tight rounded-full {{ $role === 'SuperAdmin' ? 'text-red-700 bg-red-100 dark:text-red-100 dark:bg-red-700' : 'text-green-700 bg-green-100  dark:bg-green-700 dark:text-green-100' }}">
                                    {{ $role }}
                                </span>
                            @empty
                                <span
                                    class="px-2 py-1 font-semibold leading-tight rounded-full text-gray-700 bg-gray-100 dark:bg-gray-700 dark:text-gray-100">
                                    User
                                </span>
                            @endforelse
                        </td>

                        <td class="px-4 py-3 text-sm">
                            <span data-tooltip-target="tooltip-light-2"
                                data-tooltip-style="light">{{ $user->created_at->diffForHumans() }}</span>
                            <div id="tooltip-light-2" role="tooltip"
                                class="inline-block absolute invisible z-50 py-2 px-3 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 shadow-sm opacity-0 tooltip">
                                {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('MMMM Do YYYY, h:mm:ss a') }}
                                <div class="tooltip-arrow" data-popper-arrow></div>
                        </td>
                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">

                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        @can('user_delete')
                                            <x-dropdown.item wire:click.prevent="delete({{ $user->id }})" icon="trash" label="Delete" />
                                        @endcan

                                        @can('user_edit')
                                            <x-dropdown.item icon="pencil" label="Edit" />
                                        @endcan

                                        @can(['user_give_ban','user_give_unban'])
                                            @if (!$user->banned_till)
                                                    <x-dropdown.item wire:click.prevent="openBan({{ $user->id }})" icon="ban" label="BAN" />
                                                @else
                                                    <x-dropdown.item wire:click.prevent="unban({{ $user->id }})" icon="ban" label="UNBAN" />
                                            @endif
                                        @endcan

                                        @can('user_give_verify')
                                            @if ($user->is_verified === 1)
                                                <x-dropdown.item wire:click.prevent="unVerify({{ $user->id }})" icon="badge-check" label="UNVERIFY" />
                                            @else
                                                <x-dropdown.item wire:click.prevent="verify({{ $user->id }})" icon="badge-check" label="VERIFY" />
                                            @endif
                                        @endcan

                                        @can('user_give_role')
                                            <x-dropdown.item wire:click.prevent="openRole({{ $user->id }})" label="Assign Role" icon="user-group" />
                                        @endcan

                                    </x-dropdown.header>
                                </x-dropdown>

                                {{-- flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray --}}
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="13">
                            <span class="py-10 text-red-400">
                                {{ __('NO RESULTS FOUND') }}
                            </span>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div
        class="flex justify-between px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
        <span class="flex items-center mr-2">
            per page:
            <select wire:model="paginate_page" id="countries"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @foreach ($page_numer as $page)
                    <option value="{{ $page }}" {{ $page_numer[0] ? 'selected' : '' }}>
                        {{ $page }}
                    </option>
                @endforeach
            </select>
        </span>
        <span class="col-span-2"></span>
        {{ $users->links() }}
        <!-- Pagination -->

    </div>



    <x-jet-dialog-modal wire:model="openModelBan">
        <x-slot name="title">
            BAN {{ $name }}
        </x-slot>

        <x-slot name="content">
            @if ($openModelBan)
                <div x-data="data: null">
                    {{-- <x-datetime-picker label="Appointment Date" placeholder="Appointment Date" wire:model="banned_till"
                    :min="now()" /> --}}

                    <div class="mb-5">
                        <x-select label="Select Status" placeholder="Select one status" :options="[
                            ['name' => '1 Day', 'id' => 1],
                            ['name' => '7 Day', 'id' => 7],
                            ['name' => '2 Week', 'id' => 14],
                            ['name' => '1 Month', 'id' => 30],
                            ['name' => '3 Month', 'id' => 90],
                            ['name' => '1 Year', 'id' => 365],
                            ['name' => 'Permanent', 'id' => 0],
                        ]"
                            option-label="name" option-value="id" wire:model.defer="banned_till" />
                    </div>
                    <x-textarea wire:model="banned_reason" label="Reason" placeholder="Your Reason" rows='8'
                        value="U have been Banned on {{ env('APP_NAME') }}" />
                </div>
            @endif
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModelBan')" wire:loading.attr="disabled">
                Cancell
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click.prevent="ban()" wire:loading.attr="disabled">
                BAN
            </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>

    {{-- Role Modal --}}
    <x-jet-dialog-modal wire:model="openModelRole">
        <x-slot name="title">
            Give Role To: {{ $name }}
        </x-slot>

        <x-slot name="content">
            @foreach ($get_roles as $role => $key)
                {{-- @dd($model->roles->contains($role)) --}}
                <div class="flex items-center">
                    <x-checkbox id="md" md wire:model.defer="roles" value="{{ $key }}" />
                    {{-- {{ $model->roles->contains($key) ? 'checked' : '' }} --}}
                    <span class="ml-2">{{ $role }}</span>
                </div>
            @endforeach
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('openModelRole')" wire:loading.attr="disabled">
                Cancell
            </x-jet-secondary-button>

            <x-jet-button class="ml-2" wire:click.prevent="role()" wire:loading.attr="disabled">
                Apply
            </x-jet-button>

        </x-slot>
    </x-jet-dialog-modal>
</div>
