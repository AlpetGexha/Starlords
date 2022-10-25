<div x-data="{
    isUploading: false,
    progress: 5,
    imagePreview: null,
    previewImage() {
        const render = new FileReader()
        render.onload = (event) => {
            this.imagePreview = event.target.result
        }
        render.readAsDataURL(this.$refs.image.files[0])
    }
}" x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress" x-cloak>
    <label class="block text-sm font-medium text-gray-700"> {{ __('Upload Image') }} </label>
    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
        <template x-if="imagePreview">
            <div>
                <img x-bind:src="imagePreview"
                    x-bind:width="{{ $attributes->has('width') ? $attributes->get('width') : '400' }}"
                    x-bind:height="{{ $attributes->has('height') ? $attributes->get('height') : '320' }}">
            </div>
        </template>
        <div class="space-y-1 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48"
                aria-hidden="true">
                <path
                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <div class="flex text-sm text-gray-600">
                <label for="file-upload"
                    class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                    <span>Upload a Image</span>
                    <input id="file-upload" {{ $attributes->whereStartsWith('wire:model') }}
                        {{ $attributes->has('multiple') ? 'multiple' : '' }} x-ref="file"
                        x-on:change="{{ $attributes->has('preview') ? 'previewImage()' : '' }}" type="file"
                        class="sr-only" accept="image/*">
                </label>
                <p class="pl-1">or drag and drop</p>
            </div>
            <p class="text-xs text-gray-500">PNG, JPG, GIF</p>
        </div>
    </div>
    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
        <div class="progress-bar bg-primary progress-bar-striped" x-bind:style="`width: ${progress}%`"
            role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="99">
            <span class="sr-only">{{ __('40% Complete (success)') }}</span>
        </div>
    </div>
    <div x-show.transition="isUploading" class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"x-bind:style="`width: ${progress}%`"
            role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="99" x-text="progress + '%'"> </div>
    </div>
</div>
