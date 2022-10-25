<x-app-layout>
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">

        <div class="py-10">
            <div class="max-w-3xl mx-auto sm:px-6 lg:max-w-7xl lg:px-8 lg:grid lg:grid-cols-12 lg:gap-8">
                <main class="lg:col-span-9 xl:col-span-8">

                    <div>
                        <h1 class="sr-only">{{ $blog->title }}</h1>

                        <div class="bg-white px-4 py-6 shadow sm:p-6 sm:rounded-lg dark:bg-gray-800">
                            <article aria-labelledby="post-title">
                                <div>
                                    <div class="flex space-x-3">
                                        <div class="flex-shrink-0">
                                            <img class="h-10 w-10 rounded-full" src="{{ $blog->user->avatar }}"
                                                alt="{{ $blog->user->username() }}">
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                <a href="#">{{ $blog->user->username() }}</a>
                                            </p>

                                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                                <time datetime="2022-04-30">
                                                    {{ str()->getDate($blog->created_at) }}
                                                </time>

                                                <span aria-hidden="true">
                                                    &middot;
                                                </span>

                                                <span>
                                                    {{ str()->readTime($blog->body) }} min read
                                                </span>
                                            </p>
                                        </div>

                                        {{-- <div class="flex-shrink-0 self-center flex z-50">
                                            <div x-data="{ open: false }" @keydown.escape.stop="open = false"
                                                @click.away="open = false" class="relative inline-block text-left">
                                                <div>
                                                    <button type="button"
                                                        class="-m-2 p-2 rounded-full flex items-center text-gray-400 hover:text-gray-600"
                                                        id="share-1" @click="open = !open" aria-haspopup="true"
                                                        x-bind:aria-expanded="open">
                                                        <span class="sr-only">Open options</span>
                                                        <svg class="h-5 w-5" x-description="solid/dots-vertical"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z">
                                                            </path>
                                                        </svg>
                                                    </button>
                                                </div>

                                                <div x-show="open"
                                                    x-transition:enter="transition ease-out duration-100"
                                                    x-transition:enter-start="transform opacity-0 scale-95"
                                                    x-transition:enter-end="transform opacity-100 scale-100"
                                                    x-transition:leave="transition ease-in duration-75"
                                                    x-transition:leave-start="transform opacity-100 scale-100"
                                                    x-transition:leave-end="transform opacity-0 scale-95"
                                                    class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none dark:bg-gray-700"
                                                    role="menu" aria-orientation="vertical" aria-labelledby="share-1"
                                                    style="display: none;">
                                                    <div class="py-1" role="none">
                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Frappasoft.com%2Fblog%2Fwhats-new-in-livewire-tables-v21-24&t=What&#039;s New in Livewire Tables v2.1-2.4"
                                                            onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                                            class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800"
                                                            role="menuitem" target="_blank">
                                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                                x-description="solid/share"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path
                                                                    d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z">
                                                                </path>
                                                            </svg>

                                                            <span>Share to Facebook</span>
                                                        </a>

                                                        <a href="https://twitter.com/share?url=https%3A%2F%2Frappasoft.com%2Fblog%2Fwhats-new-in-livewire-tables-v21-24&via=Rppasoft&text=What&#039;s New in Livewire Tables v2.1-2.4"
                                                            onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');return false;"
                                                            class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800"
                                                            role="menuitem" target="_blank">
                                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                                x-description="solid/share"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path
                                                                    d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z">
                                                                </path>
                                                            </svg>

                                                            <span>Share to Twitter</span>
                                                        </a>

                                                        <a href="http://www.reddit.com/submit?url=https%3A%2F%2Frappasoft.com%2Fblog%2Fwhats-new-in-livewire-tables-v21-24&title=What%27s+New+in+Livewire+Tables+v2.1-2.4"
                                                            class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800"
                                                            role="menuitem" target="_blank">
                                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                                x-description="solid/share"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor" aria-hidden="true">
                                                                <path
                                                                    d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z">
                                                                </path>
                                                            </svg>

                                                            <span>Share to Reddit</span>
                                                        </a>

                                                        <a x-data="{ url: 'https://rappasoft.com/blog/whats-new-in-livewire-tables-v21-24' }"
                                                            @click.prevent="copyToClipboard(url);alert('Copied!');"
                                                            href="#"
                                                            class="flex px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-400 dark:hover:bg-gray-800"
                                                            role="menuitem">
                                                            <svg class="mr-3 h-5 w-5 text-gray-400"
                                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke="currentColor">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2"
                                                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                                                            </svg>

                                                            <span>Copy Link</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <h1 id="post-title"
                                        class="mt-4 mb-2 text-base font-bold text-2xl text-gray-900 dark:text-white">
                                        {{ $blog->title }}
                                    </h1>

                                    <hr />
                                </div>

                                <div class="mt-4 text-sm text-gray-700 space-y-4 prose max-w-full dark:prose-dark">

                                    {!! $blog->body !!}

                                    <div class="mt-6 flex justify-between space-x-8">
                                        <div class="flex space-x-6">
                                            <!-- Livewire Component wire-end:cQwMhroBGEx5xNevWaW7 -->
                                            <span class="inline-flex items-center text-sm">
                                                <span class="inline-flex space-x-2 text-gray-400">
                                                    <svg class="h-5 w-5" x-description="solid/eye"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" aria-hidden="true">
                                                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                                                        <path fill-rule="evenodd"
                                                            d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span
                                                        class="font-medium text-gray-900 dark:text-gray-400">{{ $blog->views }}</span>
                                                    <span class="sr-only">views</span>
                                                </span>
                                            </span>
                                        </div>

                                        <div class="flex-shrink-0 self-center flex z-50">
                                            <div x-data="{ open: false }" @keydown.escape.stop="open = false"
                                                @click.away="open = false" class="relative inline-block text-left">
                                                <div>
                                                    <button @click="open = !open" aria-haspopup="true"
                                                        x-bind:aria-expanded="open"
                                                        class="inline-flex space-x-2 text-gray-400 hover:text-gray-500"
                                                        id="share-2">
                                                        <span class="sr-only">Open options</span>
                                                        <svg class="h-5 w-5" x-description="solid/share"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" aria-hidden="true">
                                                            <path
                                                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z">
                                                            </path>
                                                        </svg>
                                                        <span
                                                            class="font-medium text-gray-900 text-sm dark:text-gray-400">Share</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </article>
                        </div>
                    </div>

                </main>

                <aside class="lg:col-span-3 xl:col-span-4">
                    <div class="mt-4 space-y-4 lg:mt-0">


                        <div class="overflow-hidden bg-white shadow sm:rounded-lg dark:bg-gray-800">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    Post Information
                                </h3>
                            </div>

                            <div class="px-4 py-5 border-t border-gray-200 sm:p-0 dark:border-gray-600">
                                <dl class="divide-y divide-gray-200 dark:divide-gray-600">
                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Categories:
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            {{-- @forelse ($blog->category as $e)
                                                <a href="#" class="inline-block ">
                                                    <span
                                                        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                                        {{ $e->title }}
                                                    </span>
                                                </a>
                                            @empty
                                            @endforelse --}}
                                        </dd>
                                    </div>

                                    <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                            Tags:
                                        </dt>
                                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                            @php
                                                $tag = $blog->tags->first();
                                                $tags = [];
                                                if (!is_null($tag)) {
                                                    $tags = explode(',', $tag->name);
                                                }
                                            @endphp

                                            @foreach ($tags as $tag)
                                                <a href="#" class="inline-block mb-2">
                                                    <span
                                                        class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-indigo-100 text-indigo-800">
                                                        {{ $tag }}
                                                    </span>
                                                </a>
                                            @endforeach

                                        </dd>
                                    </div>
                                </dl>
                            </div>
                        </div>

                        {{-- <div class="overflow-hidden bg-white shadow sm:rounded-lg dark:bg-gray-800">
                            <div class="px-4 py-5 sm:px-6">
                                <h3 class="text-lg font-medium leading-6 text-gray-900 dark:text-white">
                                    Support Me
                                </h3>
                            </div>
                            <div class="px-4 py-5 border-t border-gray-200 sm:p-0 dark:border-gray-600">
                                <dl class="divide-y divide-gray-200 dark:divide-gray-600">
                                    <div class="py-4 sm:py-5 sm:px-6">
                                        <a href="#"
                                            class="font-medium text-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:hover:text-indigo-300"
                                            target="_blank">Sponsor Us</a>
                                    </div>
                                </dl>
                            </div>
                        </div> --}}

                    </div>
                </aside>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://rappasoft.com/js/plugin/highlightjs/languages/blade.min.js"></script>

    <script type="text/javascript">
        hljs.highlightAll();

        function copyToClipboard(text) {
            if (window.clipboardData && window.clipboardData.setData) {
                // Internet Explorer-specific code path to prevent textarea being shown while dialog is visible.
                return window.clipboardData.setData("Text", text);

            } else if (document.queryCommandSupported && document.queryCommandSupported("copy")) {
                var textarea = document.createElement("textarea");
                textarea.textContent = text;
                textarea.style.position = "fixed"; // Prevent scrolling to bottom of page in Microsoft Edge.
                document.body.appendChild(textarea);
                textarea.select();
                try {
                    return document.execCommand("copy"); // Security exception may be thrown by some browsers.
                } catch (ex) {
                    console.warn("Copy to clipboard failed.", ex);
                    return false;
                } finally {
                    document.body.removeChild(textarea);
                }
            }
        }
    </script>
    </body>

    </html>
</x-app-layout>
