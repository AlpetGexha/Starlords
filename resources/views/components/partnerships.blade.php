@props(['sponzors'])

<section class="container mx-auto pt-16 my-5">
    <div class="w-11/12 xl:w-2/3 lg:w-2/3 md:w-2/3 mx-auto sm:mb-10 mb-16">
        <h1 tabindex="0"
            class="focus:outline-none xl:text-5xl md:text-3xl text-xl dark:text-white text-center text-cyan-500 font-extrabold mb-5 pt-4">
            {{ __('Partnerships with StarLords') }}
        </h1>
        <p tabindex="0"
            class="focus:outline-none text-base md:text-lg lg:text-xl dark:text-gray-200 text-center text-gray-600 font-normal xl:w-10/12 xl:mx-auto">
            Our success has come from being committed to the property and investing in the development of the
            product to maximize sales. At the same time and maintaining the integrity.
        </p>
    </div>

    <div class="xl:py-16 lg:py-16 md:py-16 sm:py-16 px-15 flex flex-wrap">
        @foreach ($sponzors as $s)
            <a href="{{ $s->url }}"
                class="w-6/12 xl:w-1/4 lg:w-1/4 md:w-1/4 flex justify-center xl:pb-10 pb-16 items-center">
                <img width="200" height="200" src="{{ $s->url_image }}" alt="{{ $s->name }}" tabindex="0"
                    role="img" loading='lazy' />
            </a>
        @endforeach
    </div>

</section>
