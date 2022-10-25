<div x-data="{
    isSubscribe: @json($model->isSubscribedBy(auth()->user())),
    isNotify: @entangle('notify'),

    saveText: function() {
        return this.isSubscribe ? 'Subscribed' : 'Subscribe';
    },

    toogleSubscribe: function() {
        if (this.isSubscribe) {
            this.saveText();
            this.isSubscribe = false;
        } else {
            this.saveText();
            this.isSubscribe = true;
        }
    },
    toogleNotify: function() {
        if (this.isNotify) {
            this.isNotify = false;
        } else {
            this.isNotify = true;
        }
    }
}">

    <button class="focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2" x-on:click="toogleSubscribe"
        wire:click.prevent='sub()'
        x-bind:class="!isSubscribe
            ? 'text-white bg-red-500 hover:bg-red-500 focus:ring-4 focus:ring-red-300  dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900'
            : 'text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700'">
        <span class="font-medium text-gray-900" x-text='saveText'>Subscribe</span>
    </button>

        <span x-show="isSubscribe">
            <button type="submit"
                wire:click.prevent="notify()"
                x-on:click="toogleNotify"
                title="Dont Miss Any Event Ever">
                <i class="focus:outline-none focus:ring-4 focus:ring-gray-200"
                    x-bind:class="!isNotify
                        ? 'fa-regular fa-bell'
                        : 'fa-solid fa-bell'">
                </i>
            </button>
        </span>

</div>
