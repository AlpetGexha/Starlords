@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
        integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

<section class="2xl:container 2xl:mx-auto lg:py-10 lg:px-12 md:py-8 md:px-6 py-2Q   ` dark:bg-gray-900">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 lg:px-6">
        <div class="mx-auto mb-8 max-w-screen-sm lg:mb-16">
            <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">Our team</h2>
            <p class="font-light text-gray-500 sm:text-xl dark:text-gray-400">
                {{ $setting->team_body }}
            </p>
        </div>
        <div class="flex justify-center p-4">
            <div class="owl-carousel owl-theme" wire:init='loadTeam'>
                @forelse ($teams as $t)
                    <div class="text-center text-gray-500 dark:text-gray-400 item">
                        <img class="mx-auto mb-4 rounded-full" loading="lazy" style="width: 220px; !important"
                        src="{{ $t->getMedia('team')->first()? $t->getMedia('team')->first()->getUrl(): config('app.no_file') }}"
                        alt="">
                        <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            <a href="#">{{ $t->name }}</a>
                        </h3>
                        <p>{{ $t->position }}</p>
                        <ul class="flex justify-center mt-4 space-x-4">
                            <li>
                                <a href="{{ $t->twitter }}" title="Twitter"
                                    class="text-[#00acee] hover:text-gray-900 dark:hover:text-white">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path
                                            d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $t->github }}" title="Github"
                                    class="text-gray-900 hover:text-gray-900 dark:hover:text-white dark:text-gray-300">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd"
                                            d="M12 2C6.477 2 2 6.484 2 12.017c0 4.425 2.865 8.18 6.839 9.504.5.092.682-.217.682-.483 0-.237-.008-.868-.013-1.703-2.782.605-3.369-1.343-3.369-1.343-.454-1.158-1.11-1.466-1.11-1.466-.908-.62.069-.608.069-.608 1.003.07 1.531 1.032 1.531 1.032.892 1.53 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.113-4.555-4.951 0-1.093.39-1.988 1.029-2.688-.103-.253-.446-1.272.098-2.65 0 0 .84-.27 2.75 1.026A9.564 9.564 0 0112 6.844c.85.004 1.705.115 2.504.337 1.909-1.296 2.747-1.027 2.747-1.027.546 1.379.202 2.398.1 2.651.64.7 1.028 1.595 1.028 2.688 0 3.848-2.339 4.695-4.566 4.943.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0022 12.017C22 6.484 17.522 2 12 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="{{ $t->linkedin }}" title="Linkedin"
                                    class="text-[#00acee] hover:text-gray-900 dark:hover:text-white">
                                    <i class="fa-brands fa-linkedin w-6 h-6"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                @empty
                    <strong><span class="text-lg text-center p-3 my-3 text-red-500">No Team </span></strong>
                @endforelse
            </div>

        </div>
    </div>

</section>
@push('scripts')
    @once
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
            integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    loop: true,
                    lazyLoad: true,
                    margin: 10,
                    nav: true,
                    autoplay: true,
                    autoplayTimeout: 2500,
                    autoplayHoverPause: true,
                    animateOut: 'fadeOut',
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 3
                        },
                        1000: {
                            items: 4
                        }
                    }
                })

            });
        </script>

    @endonce
@endpush
