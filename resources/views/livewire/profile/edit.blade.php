<x-card>
    <div>
        {{-- <div>
         <h3 class="text-lg leading-6 font-medium text-gray-900">
            Profile
        </h3>
        <p class="mt-1 text-sm text-gray-500">
            This information will be displayed publicly so be careful what you share.
        </p>
    </div> --}}

        <div class="mt-1 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
            <div class="sm:col-span-4">
                <x-input wire:model.defer='name' label="Organization Name" placeholder="Organization Name" class="pl-9">
                    <x-slot name="prepend">
                        <div
                            class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                            <div class="h-[21px] w-7 rounded-l-md">
                                <i class="fa-sharp fa-solid fa-building"></i>
                            </div>
                        </div>
                    </x-slot>
                </x-input>
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='email' icon="inbox" label="Email" placeholder="Email" />
            </div>

            <div class="sm:col-span-4">
                <x-input icon="phone" label="Telxephone" placeholder="+383 12 123 456" wire:model.defer='number' />
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='website' icon="link" label="Website" placeholder="wwww.your-domain.com" />
            </div>

            <div class="sm:col-span-6">
                <x-textarea class="resize-none" row='40' label="Description"
                    placeholder="What is your organization about?" wire:model.defer='description' />
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='location' label="Location" placeholder="Location" class="pl-9">
                    <x-slot name="prepend">
                        <div
                            class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                            <div class="h-[21px] w-7 rounded-l-md">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                        </div>
                    </x-slot>
                </x-input>
            </div>

            <div class="sm:col-span-4">
                <x-select multiselect wire:model.defer='categorys' label="Categorys" placeholder="Select some status">
                    @forelse ($categoryss as $c)
                        <x-select.option label="{{ $c->title }}" value="{{ $c->title }}"
                            :selected="in_array($c->title, $categorys)" />
                            />
                        />
                    @empty
                        <x-select.option disabled label="No Categorys" value="No Categorys" />
                    @endforelse
                </x-select>
            </div>

            <div class="sm:col-span-4">
                <x-multi-tag wire:model.defer='tags' />
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='facebook' label="Facebook" placeholder="Facebook" class="pl-9">
                    <x-slot name="prepend">
                        <div
                            class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                            <div class="h-[21px] w-7 rounded-l-md">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
                        </div>
                    </x-slot>
                </x-input>
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='instagram' label="Instagram" placeholder="Instagram" class="pl-9">
                    <x-slot name="prepend">
                        <div
                            class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                            <div class="h-[21px] w-7 rounded-l-md">
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </div>
                    </x-slot>
                </x-input>
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='twitter' label="Twitter" placeholder="Twitter" class="pl-9">
                    <x-slot name="prepend">
                        <div
                            class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                            <div class="h-[21px] w-7 rounded-l-md">
                                <i class="fa-brands fa-twitter"></i>
                            </div>
                        </div>
                    </x-slot>
                </x-input>
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='linkedin' label="Linkedin" placeholder="Linkedin" class="pl-9">
                    <x-slot name="prepend">
                        <div
                            class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                            <div class="h-[21px] w-7 rounded-l-md">
                                <i class="fa-brands fa-linkedin-in"></i>
                            </div>
                        </div>
                    </x-slot>
                    </x-inpu>
            </div>

            <div class="sm:col-span-4">
                <x-input wire:model.defer='link' icon="link" label="Any Link" placeholder="wwww.domain.com" />
            </div>

            <div class="sm:col-span-6">
                <x-progres-file wire:model.defer='avatar' preview width='170' height='170' />
                <x-jet-input-error for='avatar' />
            </div>
        </div>
    </div>
    <x-slot name="footer">
        <x-buttonn wire:click.prevent='update()' type="submit"
            class="w-full {{ $errors->any() ? 'border-red-500' : '' }} ">
            {{ __('Update Organization') }}
        </x-buttonn>
    </x-slot>
</x-card>
