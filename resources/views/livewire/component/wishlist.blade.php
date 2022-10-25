<div x-data="{
    isSaved: @json($model->isWished()),

    saveText: function() {
        return this.isSaved ? 'Saved' : 'Save';
    },

    toogleSave: function() {
        if (this.isSaved) {
            this.saveText();
            this.isSaved = false;
        } else {
            this.saveText();
            this.isSaved = true;
        }
    }
}">
    @auth
        <button
            class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-700 bg-amber-300 rounded-l-lg border border-amber-700 hover:bg-amber-400 hover:text-white "
            x-on:click="toogleSave" wire:click.prevent='wish()'>

            <span class="mr-2" x-text='saveText'></span>
            <i class="far fa-bookmark"></i>
        </button>
    @else
        <a class="inline-flex items-center py-2 px-4 text-sm font-medium text-gray-700 bg-amber-300 rounded-l-lg border border-amber-700 hover:bg-amber-400 hover:text-white "
            href="{{ route('login') }}">
            <span class="mr-2">Save</span>
            <i class="far fa-bookmark"></i>
        </a>
    @endauth
</div>
