<form wire:submit.prevent="store()">
    <x-alert />

    <div class="flex flex-wrap -mr-4 -ml-4 p-0 m-0">

        <div class="flex md:flex-col lg:w-6/12 md:w-6/12 w-full md:gap-1 mb-4 pr-1 m-0">
            <div class="">
                <x-input type="text" wire:model='name' label="Name"
                    class="{{ $errors->has('name') ? 'border-red-500 ' : '' }}" name="name" id="name"
                    placeholder="Name" />
            </div>
            {{-- <x-jet-input-error for="name" class="mt-2" /> --}}
        </div>

        <div class="flex md:flex-col lg:w-6/12 md:w-6/12 w-full md:gap-1 mb-4 lg:pl-1 m-0">
            <div class="">
                <x-input type="email" wire:model.defer='email' label="Email"
                    class="{{ $errors->has('email') ? 'border-red-500 ' : '' }}" name="email" id="email"
                    placeholder="Email" />
            </div>
            {{-- <x-jet-input-error for="email" class="mt-2" /> --}}
        </div>

        <div class="flex md:flex-col w-full p-0 m-0">
            <div class="mb-4 w-full">
                <x-input type="text" wire:model.defer='subject' label="Subject"
                    class="{{ $errors->has('subject') ? 'border-red-500 ' : '' }}" name="subject" id="subject"
                    placeholder="Subject" />
                {{-- <x-jet-input-error for="subject" class="mt-2" /> --}}
            </div>
        </div>

        <div class="flex md:flex-col w-full p-0 m-0">
            <div class="mb-4">
                <x-textarea name="message" wire:model.defer='message' label="Message"
                    class="{{ $errors->has('message') ? 'border-red-500' : '' }} resize-none block p-2.5 w-full text-sm"
                    id="message" cols="50" rows="10" placeholder="Message">
                </x-textarea>
                {{-- <x-jet-input-error for="message" class="mt-2" /> --}}
            </div>
        </div>

        <div class="flex md:flex-col w-full p-0 m-0 just">
            <div class="">
                <x-buttonn type="submit">
                    {{ __('Send Message') }}
                </x-buttonn>
                {{-- <div class="float-left w-full hidden text-base font-bold py-2 px-0">
                </div> --}}
            </div>
        </div>

    </div>
</form>
