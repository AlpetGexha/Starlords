<x-app-layout>
    <div class="flex w-full items-center justify-center">
        <div class="flex w-3/4 flex-col">
            <div class="relative self-stretch">
                <img src="https://bit.ly/2EApSiC"
                    class="z-50 h-64 w-11/12 overflow-hidden rounded-b-md bg-no-repeat object-cover" alt="" />
                <!--<div class="absolute top-0 right-0 bottom-0 left-0 h-full w-full overflow-hidden bg-fixed">
          <div class="flex h-full items-center justify-center">
            <div class="px-6 text-center text-white md:px-12">
              <h1 class="visible mt-0 mb-6 text-5xl font-bold hover:invisible">User</h1>
            </div>
          </div>
        </div>-->
            </div>
            <div class="flex flex-row flex-wrap gap-4 p-2">
                <div class="p-2">
                    <div class="mt-4 h-60 rounded-lg border bg-white p-6 shadow-sm dark:border-gray-700">
                        <img class="mx-auto h-16 w-16 rounded-full"
                            src="https://www.innovaxn.eu/wp-content/uploads/blank-profile-picture-973460_1280.png" />
                        <div class="text-center">
                            <h2 class="text-lg font-bold">Florian Azemi</h2>
                            <div class="font-medium text-purple-500">Event Creator</div>
                            <div class="font-light text-gray-600">florianazemi@example.com</div>
                            <div class="font-light text-gray-600">(555) 765-4321</div>
                        </div>
                    </div>
                </div>
                <div class="flex w-fit flex-col p-2">
                    <div class="p-4">
                        <h3 class="text-2xl font-normal">Events by USER</h3>
                        <div
                            class="border-b border-gray-200 text-center text-sm font-light text-gray-500 dark:border-gray-700 dark:text-gray-400">
                            <ul class="-mb-px flex flex-wrap">
                                <li class="mr-2">
                                    <a href="#"
                                        class="inline-block rounded-t-lg border-b-2 border-transparent p-4 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300">Upcoming</a>
                                </li>


                            </ul>
                        </div>
                        <div class="flex flex-col justify-center">
                            @for ($i = 0; $i < 10; $i++)
                                <div id="app"
                                    class="bg-white w-128 h-48 rounded transition  hover:shadow-md flex card text-grey-darkest mt-4">
                                    <img class="w-1/2 h-full rounded-l-sm" src="https://bit.ly/2EApSiC"
                                        alt="Room Image">
                                    <div class="w-full flex flex-col">
                                        <div class="p-4 pb-0 flex-1">
                                            <h3 class="text-2xl font-light mb-1 text-grey-darkest">Event</h3>
                                            <div class="text-xs flex items-center mb-4">
                                                <i class="fas fa-map-marker-alt mr-1 text-grey-dark"></i>
                                                Soho, London
                                            </div>

                                            <div class="text-xs flex items-center mb-4">

                                                <button type="button"
                                                    class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out">Book
                                                    tickets</button>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            @endfor

                        </div>
                        <div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
