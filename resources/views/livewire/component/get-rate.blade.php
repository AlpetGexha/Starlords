<div class="antialiased mx-auto w-full p-2 mt-6">
    {{-- antialiased mx-auto max-w-screen-sm --}}
    <h3 class="mb-4 text-lg font-semibold text-gray-900">Reviews ({{ $comments->count() }})</h3>
    @forelse ($comments as $comment)
        <div class="space-y-4 p-2">
            <div class="flex">
                <div class="flex-shrink-0 mr-3">
                    <img class="mt-2 rounded-full w-8 h-8 sm:w-10 sm:h-10" src="{{ $comment->user->profile_photo_url }}"
                        alt="{{ $comment->user->name }}">
                </div>
                <div class="flex-1 border bg-white rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                    <strong>{{ $comment->user->name }}</strong>
                    <span class="text-xs text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    <x-star-rate :rate='$model->getUserRate($comment->user_id)' />
                    <p class="text-sm">
                        {{ $comment->body }}
                    </p>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center text-gray-500">No comments yet! Be first</div>
    @endforelse
    @if ($comments->total() > 0 && $comments->count() < $comments->total())
        <div class="flex justify-center">
            <x-button wire:click.prevent="loadMore()" class="font-bold py-2 px-4 rounded">
                Load More
            </x-button>
        </div>
    @endif
</div>
