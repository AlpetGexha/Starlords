@forelse ($profiles as $profile)
    <a href="{{ route('profile.single', ['profile' => $profile->slug]) }}"
        class="flex my-3 flex-col item-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
            src="https://yellow.place/file/image/thumb/0/0/1229/puttccyiivnwbahv.jpg" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ $profile->name }}
            </h5>
            <span class="mb-1 font-normal text-gray-700 dark:text-gray-400">Category: <span
                    class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                    {{ $profile->category }}
                </span>
            </span>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ $profile->body }}
            </p>
        </div>
    </a>
@empty
@endforelse
