<div class="antialiased mx-auto w-full p-2">
    {{-- antialiased mx-auto max-w-screen-sm --}}
    <h3 class="mb-4 text-lg font-semibold text-gray-900">Comments ({{ $count }})</h3>

    @forelse ($comments as $comment)
        <div class="space-y-4 p-2" x-data="{ comment_{{ $comment->id }}: false }">
            <div class="flex">
                <div class="flex-shrink-0 mr-3">
                    <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" src="{{ $comment->user->profile_photo_url }}"
                        alt="{{ $comment->user->name }}">
                </div>
                <div class="flex-1 border  break-all bg-white rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                    <strong>{{ $comment->user->name }}</strong> <span
                        class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    <p class="text-sm ">
                        {{ $comment->body }}
                    </p>
                    <div class="mt-4 flex items-center">
                        <div class="flex -space-x-2 mr-2">
                            <img class="rounded-full w-6 h-6 border border-white"
                                src="https://images.unsplash.com/photo-1554151228-14d9def656e4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80"
                                alt="">
                            <img class="rounded-full w-6 h-6 border border-white"
                                src="https://images.unsplash.com/photo-1513956589380-bad6acb9b9d4?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80"
                                alt="">
                        </div>
                        <div class="text-sm text-gray-500 font-semibold">
                             {{__('Replies')}}
                        </div>
                        <div class="text-sm flex">
                            <button class="ml-4 text-sm text-blue-500 font-semibold"
                                x-on:click="comment_{{ $comment->id }} = !comment_{{ $comment->id }}">
                                Reply
                            </button>
                        </div>
                    </div>
                    <div x-show="comment_{{ $comment->id }}" x-cloak>
                        <livewire:component.replies :model='$model' :comment_id='$comment->id' />
                    </div>
                    <livewire:component.getreply :model='$model' :comment_id='$comment->id' />
                </div>
            </div>

        </div>
    @empty
        <div class="text-center text-gray-500">No comments yet! Be first</div>
    @endforelse
    @if ($comments->total() > 0 && $comments->count() < $comments->total())
        <div class="flex justify-center">
            <x-buttonn wire:click.prevent="loadMore()" class="font-bold py-2 px-4 rounded">
                Load More
            </x-buttonn>
        </div>
    @endif
</div>
