<div x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    x-description="Modal panel, show/hide based on modal state."
    class="inline-block align-bottom bg-white rounded-lg px-4 pt-5 pb-4 text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-3/5 sm:p-6">
    <div class="flex sm:flex sm:items-start">


        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-center">
            <h3 class="text-3xl leading-6 font-medium text-gray-900" id="modal-title">
                {{ __('Ticket For') }} {{ $event->title }}
            </h3>
            <script src="https://js.stripe.com/v3/"></script>
            <div class="mt-2">
                <div>
                    <form id="payment-form" wire:submit.prevent='makePayment()'>
                        <div class="form-row">
                            <label for="card-element">
                                {{ __('Credit or debit card') }}
                            </label>
                            <div id="card-element">
                                <!-- a Stripe Element will be inserted here. -->
                            </div>
                            <!-- Used to display form errors -->
                            <div id="card-errors"></div>
                        </div>
                        <input type="submit" class="submit" value="Submit Payment">
                    </form>


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
                            @this.set('stripeTokenKey', token.id);
                            form.appendChild(hiddenInput);

                            // form.submit();
                        }
                    </script>

                </div>

            </div>
        </div>


    </div>
    <!--end card-->
    <div class="mt-5 sm:mt-4 sm:flex sm:flex-row-reverse">
        <button type="button"
            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm"
            data-tabs-target="#dashboard" type="button" role="tab" aria-controls="dashboard">
            Continue
        </button>
        <button type="button"
            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:w-auto sm:text-sm"
            @click="open = false">
            Cancel
        </button>
    </div>
</div>
