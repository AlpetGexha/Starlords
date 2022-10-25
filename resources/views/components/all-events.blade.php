@php
$data = ['All Categories', 'Business', 'Comedy', 'Crafts', 'Fashion', 'Film', 'Galleries', 'Food & Drink', 'Music', 'Performances', 'Social', 'Sports', 'Tech', 'Other'];
@endphp
<div class="pt-5 px-35 border-b border-gray-300 bg-gray-200 ">
    <div class="w-full flex flex-wrap justify-around">
        <div class="input-group relative flex items-stretch w-96 mb-4 ">
            <input type="search"
                class="form-control justify-self-center relative flex-auto min-w-0 block w-72 px-3 h-9 text-base font-normal text-gray-400 bg-white bg-clip-padding border border-solid border-gray-300 rounded-l-lg transition ease-in-out m-0 focus:text-gray-700 focus:bg-white "
                placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
            <input type="search"
                class="form-control relative flex-auto min-w-0 block w-full px-3 w-72 h-9 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white "
                placeholder="Location" aria-label="Location" aria-describedby="button-addon2">
            <button
                class="btn inline-block px-6  h-9 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded-r-lg  hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center"
                type="button" id="button-addon2">
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4"
                    role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                    <path fill="currentColor"
                        d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z">
                    </path>
                </svg>
            </button>
        </div>
        <div class="justify-self-end">
            <button id="dropdownBgHoverButton" data-dropdown-toggle="dropdownBgHover"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 h-9 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Filter Events <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div id="dropdownBgHover" class="z-10 w-96 bg-white rounded-lg shadow flex mt-7 hidden"
                data-popper-reference-hidden="" data-popper-escaped="" data-popper-placement="bottom"
                style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate3d(585px, 887px, 0px);">
                <ul class="p-3 space-y-1 text-sm text-gray-200" aria-labelledby="dropdownBgHoverButton">
                    <p class="text-gray-600">Category</p>
                    @foreach ($data as $category)
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-200 ">
                                <input id="checkbox-item-4" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-200 dark:border-gray-500">
                                <label for="checkbox-item-4"
                                    class="ml-2 w-full text-sm font-normal text-gray-500 rounded ">{{ $category }}</label>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <ul class="p-3 space-y-1 text-sm text-gray-200" aria-labelledby="dropdownBgHoverButton">
                    <p class="text-gray-600">Price</p>
                    @for ($i = 0; $i < 2; $i++)
                        <li>
                            <div class="flex items-center p-2 rounded hover:bg-gray-100 dark:hover:bg-gray-200 ">
                                <input id="checkbox-item-4" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-200 dark:border-gray-500">
                                <label for="checkbox-item-4"
                                    class="ml-2 w-full text-sm font-normal text-gray-500 rounded ">
                                    Price {{ $i }}
                                </label>
                            </div>
                        </li>
                    @endfor
                </ul>
            </div>
        </div>
    </div>
</div>
