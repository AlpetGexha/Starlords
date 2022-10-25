
<div class="absolute top-0 w-full h-full bg-center bg-cover"
    style="background-image:url('');">
    <form class=" container mx-auto backdrop-blur-md backdrop-brightness-125 p-6 md:p-10 rounded w-full  ">
        <h1 class="max-w mb-4 text-4xl font-bold tracking-tight leading-none md:text-5xl xl:text-6xl text-white">
            {{ $setting->home_words }}
        </h1>
        <livewire:event.search />
    </form>
    <style>
        .bg-smoke-dark {
            background-color: rgba(0, 0, 0, 0.6);
        }

        .hero-section {
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            min-height: 25vh;
            
           
        }
    </style>
</div>
