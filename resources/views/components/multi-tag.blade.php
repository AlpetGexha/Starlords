<div x-data @tags-update="console.log('tags updated', $event.detail.tags); @this.set('tags',$event.detail.tags)" data-tags='[]' class="" wire:ignore>
    <div x-data="tagSelect()" x-init="init('parentEl')" @click.away="clearSearch()" @keydown.escape="clearSearch()">
        <div class="relative" @keydown.enter.prevent="addTag(textInput)">

            <x-input x-model="textInput" x-ref="textInput" @input="search($event.target.value)" label="Tags"
                placeholder="Enter some tags" class="pl-9">
                <x-slot name="prepend">
                    <div class="absolute inset-y-0 left-0 pl-2.5 flex items-center pointer-events-none text-secondary-400">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5.25 8.25h15m-16.5 7.5h15m-1.8-13.5l-3.9 19.5m-2.1-19.5l-3.9 19.5" />
                          </svg>
                    </div>
                </x-slot>
            </x-input>

            <div :class="[open ? 'block' : 'hidden']" x-show='open' x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0">
                <div class="absolute z-40 left-0 mt-2 w-full">
                    <div class="py-1 text-sm bg-white rounded shadow-lg border border-gray-300">
                        <a @click.prevent="addTag(textInput)"
                            class="block py-1 px-5 cursor-pointer hover:bg-indigo-600 hover:text-white">
                            Add tag"
                            <span class="font-semibold" x-text="textInput"></span>"</a>
                    </div>
                </div>
            </div>
            <!-- selections -->
            <template x-for="(tag, index) in tags">
                <div class="bg-indigo-100 inline-flex items-center text-sm rounded mt-2 mr-1">
                    <span class="ml-2 mr-1 leading-relaxed truncate max-w-xs" x-text="tag"></span>
                    <button @click.prevent="removeTag(index)"
                        class="w-6 h-8 inline-block align-middle text-gray-500 hover:text-gray-600 focus:outline-none">
                        <svg class="w-6 h-6 fill-current mx-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path fill-rule="evenodd" d="M15.78 14.36a1 1 0 0 1-1.42 1.42l-2.82-2.83-2.83 2.83a1 1 0 1 1-1.42-1.42l2.83-2.82L7.3 8.7a1 1 0 0 1 1.42-1.42l2.83 2.83 2.82-2.83a1 1 0 0 1 1.42 1.42l-2.83 2.83 2.83 2.82z" />
                        </svg>
                    </button>
                </div>
            </template>
            <input {{ $attributes->whereStartsWith('wire:model') }} type="hidden" id='tags' x-model='tags'>
        </div>
    </div>
</div>

<script>
    function tagSelect() {
        return {
            open: false,
            textInput: '',
            tags: [],
            init() {
                this.tags = JSON.parse(this.$el.parentNode.getAttribute('data-tags'));
            },
            addTag(tag) {
                tag = tag.trim()
                if (tag != "" && !this.hasTag(tag)) {
                    this.tags.push(tag)
                }
                this.clearSearch()
                this.$refs.textInput.focus()
                this.fireTagsUpdateEvent()
            },
            fireTagsUpdateEvent() {
                this.$el.dispatchEvent(new CustomEvent('tags-update', {
                    detail: {
                        tags: this.tags
                    },
                    bubbles: true,
                }));
            },
            hasTag(tag) {
                var tag = this.tags.find(e => {
                    return e.toLowerCase() === tag.toLowerCase()
                })
                return tag != undefined
            },
            removeTag(index) {
                this.tags.splice(index, 1)
                this.fireTagsUpdateEvent()
            },
            search(q) {
                if (q.includes(",")) {
                    q.split(",").forEach(function(val) {
                        this.addTag(val)
                    }, this)
                }
                this.toggleSearch()
            },
            clearSearch() {
                this.textInput = ''
                this.toggleSearch()
            },
            toggleSearch() {
                this.open = this.textInput != ''
            }
        }
    }
</script>
