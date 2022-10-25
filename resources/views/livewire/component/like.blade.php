<span class="inline-flex items-center text-sm" x-data="{
    likeCount: @json($count),
    isLiked: @json($model->isLiked()),
    toogleLike: function() {
        if (this.isLiked) {
            this.likeCount--;
            this.isLiked = false;
        } else {
            this.likeCount++;
            this.isLiked = true;
        }
    }
}">
    <button wire:click="like" x-on:click="toogleLike"
        x-bind:class="isLiked ? 'bg-green-500 hover:text-white' : 'text-white hover:text-white'" type="button"
        class="inline-flex items-center py-2 px-4 text-sm font-medium text-white bg-green-500 rounded-r-md border border-l-0 border-green-700 hover:bg-green-600 hover:text-white">
        <span class="mr-2" x-text='likeCount'></span>
        <i class="far fa-thumbs-up"></i>
    </button>
</span>
