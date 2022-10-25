<div class="w-full overflow-hidden rounded-lg shadow-xs" x-data="datatables()" x-cloak>
    @include('components.checkboxtable')
    <div class="mb-4 flex justify-between items-center" x-data="open: false">
        <div class="flex-1 pr-4">
            <div class="relative md:w-1/2">
                <x-input type="search" class="font-medium shadow pr-4 rounded-lg" icon="search" placeholder="Search..."
                    wire:model='search' />
            </div>
        </div>
        <div>
            @can('blog_create')
                <x-button purple label="Create" href="{{ route('admin.blog.create') }}" />
            @endcan
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
                    <th class='px-4 py-3'>Photo</th>
                    <th class='px-4 py-3'>Title</th>
                    <th class='px-4 py-3'>Slug</th>
                    <th class='px-4 py-3'>Body</th>

                    <th class="px-4 py-3">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @forelse ($blogs as $Blog)
                    <tr class="text-gray-700 dark:text-gray-400">
                        <td>
                            <x-checkbox class="rowCheckbox" id="checkbox"
                                x-on:click="getRowDetail($event, {{ $Blog->id }})" value="{{ $Blog->id }}" />
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                                <img class="ring- object-cover w-full h-full rounded-full"
                                    src="{{ $Blog->getMedia('blog')->first()? $Blog->getMedia('blog')->first()->getUrl(): config('app.no_file') }}"
                                    alt="{{ $Blog->name }}">
                                <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                                </div>
                            </div>
                        </td>


                        <td class='px-4 py-3 text-sm'>
                            {{ $Blog->title }}
                        </td>

                        <td class='px-4 py-3 text-sm'>
                            <a href="{{ route('blog.single', ['blog' => $Blog->slug]) }}">
                                {{ $Blog->slug }}
                            </a>
                        </td>

                        <td class='px-4 py-3 text-sm truncate'>
                            {{ str(strip_tags($Blog->body))->limit(100) }}
                        </td>

                        <td class="px-4 py-3">
                            <div class="flex items-center space-x-4 text-sm">

                                <x-dropdown>
                                    <x-dropdown.header label="Action">
                                        @can('blog_delete')
                                            <x-dropdown.item wire:click.prevent="delete({{ $Blog->id }})" icon="trash"
                                                label="Delete" />
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
                            <span class="py-4 text-red-500 uppercase text-lg"> {{ __('No data found') }} </span>
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
        <!-- Pagination -->
        {{ $blogs->links() }}
    </div>
</div>
