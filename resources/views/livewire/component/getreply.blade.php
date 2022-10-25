<div class="space-y-4 mt-2 ml-3">
    @foreach ($replys as $r)
        <div class="flex">
            <div class="flex-shrink-0 mr-3">
                <img class="mt-3 rounded-full w-6 h-6 sm:w-8 sm:h-8"
                    src="https://images.unsplash.com/photo-1604426633861-11b2faead63c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=200&h=200&q=80"
                    alt="">
            </div>
            <div class="flex-1 bg-gray-100 rounded-lg px-4 py-2 sm:px-6 sm:py-4 leading-relaxed">
                <strong>Sarah</strong> <span class="text-xs text-gray-400">{{ $r->created_at->diffForHumans() }}</span>
                <p class="text-xs sm:text-sm">
                    {{ $r->body }}
                </p>
            </div>
        </div>
    @endforeach
    <div class="flex justify-end text-sm mr-4">
        @if ($replys->count() > 1)
            <button wire:click.prevent='loadLess(3)'> <i class="fa-solid fa-arrow-up" title="Load Less Replys"></i>
            </button>
        @endif
        @if ($replys->hasMorePages())
            <button wire:click.prevent='loadMore(3)'> <i class="fa-solid fa-arrow-down" title="Load More Replys"></i>
            </button>
        @endif
    </div>
</div>
