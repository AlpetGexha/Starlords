{{-- @dd($event) --}}

<x-app-layout>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
    @push('head_scripts')
        <script src="https://js.stripe.com/v3/"></script>
    @endpush

    <div id="default-carousel" class="relative w-full h-full bg-[url('{{ $event->getImage() }}')] bg-cover bg-center"
        style="backdrop-filter: blur(70px);" data-carousel="static">
        {{-- <div class="absolute inset-0  bg-[url('{{ $event->getImage() }}')] mix-blend-hue"></div> --}}
        <div class="absolute inset-0  bg-gradient-to-t from-blue-600 via-blue-600 opacity-20"></div>
        <div id="default-carousel" class="container mx-auto relative" data-carousel="static">
            <div class="relative pt-64 pb-10 shadow-2xl overflow-hidden">
                <img class="absolute inset-0 shadow-2xl rounded-lg object-cover inner-shadow h-full w-full"
                    src="{{ $event->getImage() }}" alt="{{ $event->title }}">

                <div class="relative px-8">
                    <div class="relative text-4xl font-extrabold text-white md:flex-grow">
                        <p> {{ $event->title }}</p>
                    </div>
                    <blockquote class="mt-8">
                        <div class="relative text-xl font-medium text-white md:flex-grow">

                            <p class="relative">
                                {{ $event->body }}
                            </p>
                        </div>

                        <footer class="mt-4">
                            <p class="text-base font-semibold text-blue-200">Event Host - {{ $event->user->username() }}
                            </p>
                        </footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>

    <div class="flex flex-wrap sticky top-[6rem] bg-gray-100 border-b border-gray-200">
        <div class="container mx-auto ">
            <div class=" dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400"
                    x-data="{ selected: 'description' }">
                    <li class="mr-2">
                        <a href="#description" class="inline-flex p-4 rounded-t-lg border-b-2 group" role="tab"
                            x-on:click="selected = 'description'"
                            :class="selected === 'description' ?
                                'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : ''"
                            aria-controls="description" aria-selected="false" id="description2">
                            Description
                        </a>
                    </li>
                    <li class="mr-2">

                        <a href="#date" x-on:click="selected = 'date'"
                            :class="selected === 'date' ?
                                'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : ''"
                            class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group"
                            role="tab" aria-controls="date" aria-selected="false" aria-current="page"
                            id="date2">
                            Date and time
                        </a>
                    </li>

                    <li class="mr-2">
                        <a href="#location" x-on:click="selected = 'location'" role="tab"
                            @click="selected = 'location'"
                            :class="selected === 'location' ?
                                'text-blue-600 border-blue-600 active dark:text-blue-500 dark:border-blue-500' : ''"
                            aria-controls="location" aria-selected="false" id="location2"
                            class="inline-flex p-4  rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            Location
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="#host" id="host2" role="tab" aria-controls="host" aria-selected="false"
                            class="inline-flex p-4 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                            Host
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </div>

    <div class="container mx-auto flex flex-wrap ">
        <!-- Post Section -->
        <section class="w-full md:w-2/3 flex flex-col items-left  my-4">
            <section class="my-4">
                <x-card class="flex flex-col">
                    <div class="grid grid-cols-6  mt-4">
                        <div class="col-start-1 pl-4 col-span-4 " id="description">
                            <div class="flex">
                                @forelse ($event->category as $category)
                                    <a href=""
                                        class="bg-blue-100 mb-4 hover:bg-blue-200 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800 dark:hover:bg-blue-300">
                                        {{ $category->title }}
                                    </a>
                                @empty
                                @endforelse
                            </div>
                            <p href="#" class="text-sm pb-3">
                                By <a href="#"
                                    class="font-semibold hover:text-gray-800">{{ $event->user->username() }}</a>,
                                Published on
                                <span
                                    class="bg-blue-100 text-blue-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                    <svg aria-hidden="true" class="mr-1 w-3 h-3" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    {{ str()->getFullDate($event->created_at) }}
                                </span>
                            </p>

                            <p class="text-3xl font-bold hover:text-gray-700 pb-4">
                                {{ $event->title }}
                            </p>

                            <p class="pb-3 text-gray-500">
                                {{ $event->body }}
                            </p>

                        </div>
                    </div>
                </x-card>
            </section>

            <section class="my-4">
                <x-card id="date" class="w-full flex flex-col text-center md:text-left md:flex-row sm:rounded-lg">
                    <div class=" pl-6 p-4 flex items-center space-x-4 ">
                        <div class=" flex flex-col justify-between " id="description">
                            <p class="text-2xl font-bold hover:text-gray-700 pb-4">
                                Date
                            </p>
                            <div date-rangepicker class="flex items-center">
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>

                                    <p
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        {{ str()->getDateWithoutYear($event->start_data) }}
                                    </p>

                                </div>
                                <span class="mx-4 text-gray-500">to</span>
                                <div class="relative">
                                    <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                            fill="currentColor" viewBox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <input name="end" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        value="{{ str()->getDateWithoutYear($event->end_data) }}" disabled
                                        placeholder="Select date end">
                                </div>
                            </div>
                        </div>
                    </div>
                </x-card>
            </section>

            <section class="my-4">
                <x-card id="location"
                    class="w-full flex flex-col text-center md:text-left md:flex-row  overflow-hidden rounded-lg sm:rounded-lg">
                    <div class=" p-4 flex items-center space-x-4">

                        <div class="font-medium dark:text-white">
                            <p class="text-2xl font-bold hover:text-gray-700 pb-4">
                                {{ __('Location: ') }}
                            </p>

                            <iframe
                                src="https://maps.google.com/maps?q=starlab%20prishtin&t=&z=19&ie=UTF8&iwloc=&output=embed"
                                width="100%" height="100%" frameborder="0" scrolling="no" marginheight="0"
                                marginwidth="0">
                            </iframe>

                        </div>
                    </div>
                </x-card>
            </section>

            <section class="my-4">
                <x-card id="host"
                    class="w-full flex flex-col text-center md:text-left md:flex-row  overflow-hidden rounded-lg sm:rounded-lg">
                    <div class="p-4 flex items-center space-x-4">
                        <img class="w-20 h-20 rounded"
                            src="https://source.unsplash.com/collection/1346951/150x150?sig=1" alt="">
                        <div class="font-medium dark:text-white">
                            <div class="text-xl font-bold">{{ $event->user->username() }}
                                @if ($event->user->isVerified())
                                    <span
                                        class="inline-flex items-center p-1 mr-2 text-sm font-semibold text-blue-800 bg-blue-100 rounded-full dark:bg-blue-200 dark:text-blue-800">
                                        <svg aria-hidden="true" class="w-3 h-3" fill="currentColor"
                                            viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd"
                                                d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        <span class="sr-only">Icon description</span>
                                    </span>
                                @endif
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel neque non libero
                                suscipit suscipit eu eu urna.
                            </div>
                            <div
                                class="flex items-center justify-center md:justify-start text-xl no-underline text-gray-800  pt-4">
                                <a class="hover:text-blue-600" href="#">
                                    <i class="fab fa-facebook"></i>
                                </a>
                                <a class="pl-4 hover:text-blue-600" href="#">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a class="pl-4 hover:text-blue-600" href="#">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a class="pl-4 hover:text-blue-600" href="#">
                                    <i class="fab fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </x-card>
            </section>

            <div class="inline-flex rounded-md shadow-sm pt-4" role="group">
                <livewire:component.wishlist :model="$event" />
                <livewire:component.like :model='$event' />
            </div>

            <livewire:component.comment :model='$event' />
            <livewire:component.getcommnet :model='$event' />

        </section>

        <!-- Sidebar Section -->
        <aside id="parentPurchase" x-data="{ open: false }" x-cloak
            class="w-full md:w-1/3 flex flex-col items-center">
            <div class="flex flex-col p-12 sticky top-20 z-50">

                <x-card id="purchaseDiv" class="w-full overflow-hsidden sm:rounded-lg">
                    <p class="pb-2"><b>Price: {{ $event->price }}€</b></p>
                    <div style="color: #6f7881">
                        <p> Location: {{ $event->location }}</p>
                        <p>
                            Data: {{ \Carbon\Carbon::parse($event->start_data)->isoFormat('MMM Do YYYY h:mm') }} -
                            {{ \Carbon\Carbon::parse($event->end_data)->isoFormat('MMM Do YYYY h:mm') }}
                        </p>
                    </div>

                    <button type="button"
                        class="w-full font-bold text-md uppercase text-white rounded flex items-center justify-center px-2 py-4 mt-4 bg-blue-500"
                        @click="open = !open">
                        {{ __('Get Ticket') }}
                    </button>

                </x-card>
            </div>

            <div x-show="open" class="bg-gray-300" style="height: 560px;">
                <div @click.away="open = true" @keydown.window.escape="open = false"
                    class="fixed z-50 inset-0 overflow-y-auto" aria-labelledby="modal-title" x-ref="dialog"
                    aria-modal="true">
                    <div
                        class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                            x-description="Background overlay, show/hide based on modal state."
                            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="open = false"
                            aria-hidden="true">
                        </div>

                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">​</span>

                        <div x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-description="Modal panel, show/hide based on modal state."
                            class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-3/5 sm:p-6">
                            <div class="flex sm:flex sm:items-start">


                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-center">
                                    <h3 class="text-3xl leading-6 font-medium text-gray-900 my-5" id="modal-title">
                                        {{ __('Ticket For') }} {{ $event->title }}
                                    </h3>

                                    <div class="mt-2">
                                        <div>
                                            <form id="payment-form" action="{{ route('make.payment') }}"
                                                method="POST" class="my-4"
                                                x-date="{
                                                price : {{ $event->price }},
                                                quantity : 1,
                                                final : '',
                                                getFinalPrice: function(){
                                                    return this.price * this.quantity
                                                }
                                            }">
                                                @csrf
                                                @guest
                                                    <x-input label="Email" name='email' placeholder='Email' />
                                                @endguest
                                                <div class="form-row my-5">
                                                    <div id="card-element">
                                                        <!-- a Stripe Element will be inserted here. -->
                                                    </div>
                                                    <!-- Used to display form errors -->
                                                    <div id="card-errors"></div>
                                                </div>
                                                <label for="countries"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">
                                                    {{ __('How many Ticket to u want to buy?') }}
                                                </label>
                                                <select id="countries" name='quantity'
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="1"selected>1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                </select>
                                                <h3 class="my-3"><span>Price:
                                                        <span x-text="getFinalPrice()"></span>
                                                    </span>
                                                </h3>

                                                <input type="submit"
                                                    class="submit bg-blue-500 mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                                    value="Submit Payment">
                                            </form>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <!--end card-->
                            {{-- <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
                                <button type="button"
                                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
                                    data-tabs-target="#dashboard" type="button" role="tab"
                                    aria-controls="dashboard">
                                    Continue
                                </button>
                                <button type="button"
                                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
                                    @click="open = false">
                                    Cancel
                                </button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

        </aside>
    </div>
    @push('scripts')
        <script>
            const stripe = Stripe(
                "{{ env('STRIPE_KEY') }}"
            );
            const clientSecret = "{{ env('STRIPE_SECRET') }}"
            const elements = stripe.elements();
            const card = elements.create('card');

            // Add an instance of the card UI component into the `card-element` <div>
            card.mount('#card-element');

            card.on('change', ({
                error
            }) => {
                const displayError = document.getElementById('card-errors');
                if (error) {
                    displayError.textContent = error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();

                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                var eventHiddenInput = document.createElement('input');
                eventHiddenInput.setAttribute('type', 'hidden');
                eventHiddenInput.setAttribute('name', 'event');
                eventHiddenInput.setAttribute('value', "{{ $event->id }}");
                form.appendChild(eventHiddenInput);

                form.submit();
            }
        </script>
    @endpush
</x-app-layout>
