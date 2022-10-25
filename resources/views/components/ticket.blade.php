@props(['ticket'])
<a class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row p-2 my-4 md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
    <div class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg p-2">
        {!! QrCode::generate($ticket->uuid) !!}
    </div>

    <div class="flex flex-col justify-between p-4 leading-normal">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ $ticket->event->title }}
        </h5>

        <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
            {{ $ticket->event->body }} <br>
            Price: {{ $ticket->event->price }} &euro;
        </p>

    </div>

    
</a>
