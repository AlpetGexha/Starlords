@php
    $photos = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 1, 2, 3, 4, 5, 6, 7, 8];
    $gallery_name = 'gallery1';
@endphp

<x-app-layout>
    <x-slot name='header'>
        <a href="{{ route('profile.single', ['profile' => $profile->slug]) }}">{{ $profile->name }}</a> Album
    </x-slot>

    @if (auth()->user()->username === 'admin')
        <strong class="text-red-500 text-center">
            <span >To Disaple fake image go on <code>app/config</code> and make fake_gallery false </code>'fake_gallery' => true,</code> <b>This message only you can see</b></span>
        </strong>
    @endif

    @auth
        <div class="pl-8 pr-8 my-10">
            @if ($profile->user_id == Auth::user()->id)
                <livewire:album.upload :profile='$profile->id' />
            @endif
        </div>
    @endauth

    @push('styles')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha512-nNlU0WK2QfKsuEmdcTwkeh+lhGs6uyOxuUs+n+0oXSYDok5qy0EI0lt01ZynHq6+p/tbgpZ7P+yUb+r71wqdXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js" integrity="sha512-uURl+ZXMBrF4AwGaWmEetzrd+J5/8NRkWAvJx5sbPSSuOb0bZLqf+tOzniObO00BjHa/dD7gub9oCGMLPQHtQA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('js/jquery.lazy/jquery.lazy.min.js') }}"></script>
        <script>
            $(function() {
                $('.lazy').Lazy({
                    placeholder: "data:https://upload.wikimedia.org/wikipedia/commons/c/c7/Loading_2.gif",
                    enableThrottle: true,
                    throttle: 150,
                    combined: true,
                    delay: 500,
                    effect: "fadeIn",
                    effectTime: 500,
                    threshold: 0,
                });
            });
        </script>
    @endpush


    <div class="gallery">
        <div class="pl-8 pr-8 my-10">
            <ul class="image-gallery">
                @forelse ($albums as $a)
                    <li>
                        <a href="{{ $a->getImage() }}" class="fancybox" data-fancybox="{{ $gallery_name }}">
                            <img loading='lazy' class="lazy" data-src="{{ $a->getImage() }}"
                                alt="{{ $gallery_name }}" />

                            <div class="overlay"><span></span></div>
                        </a>
                    </li>
                @empty
                    <p>No photos</p>
                @endforelse

                @if (config('app.fake_gallery'))
                    @foreach ($photos as $p)
                        <li>
                            <a href="https://picsum.photos/{{ rand('400', '900') }}/{{ rand('400', '900') }}"
                                class="fancybox" data-fancybox="gallery1">
                                <img loading='lazy' class="lazy"
                                    data-src="https://picsum.photos/{{ rand('400', '900') }}/{{ rand('400', '900') }}"
                                    alt="" />
                                <div class="overlay"><span></span></div>
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

</x-app-layout>
