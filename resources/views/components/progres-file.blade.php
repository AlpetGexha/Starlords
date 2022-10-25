<div x-data="{
    isUploading: false,
    progress: 5,
    imagePreview: null,
    previewImage() {
        const render = new FileReader()
        render.onload = (event) => {
            this.imagePreview = event.target.result
        }
        render.readAsDataURL(this.$refs.file.files[0])
    }
}" x-on:livewire-upload-start="isUploading = true"
    x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false"
    x-on:livewire-upload-progress="progress = $event.detail.progress"
    x-cloak>
    <div>
        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">
            {{ __('Upload Image') }}
        </label>

        <input type="file" {{ $attributes->whereStartsWith('wire:model') }}
            {{ $attributes->has('multiple') ? 'multiple' : '' }} x-ref="file"
            x-on:change="{{ $attributes->has('preview') ? 'previewImage()' : '' }}"
            class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
            id="file_input" accept="image/*" />

    </div>

    <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
        <div class="progress-bar bg-primary progress-bar-striped" x-bind:style="`width: ${progress}%`"
            role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
            <span class="sr-only">{{ __('40% Complete (success)') }}</span>
        </div>
    </div>
    <div x-show.transition="isUploading" class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
        <div class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"x-bind:style="`width: ${progress}%`"
            role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-text="progress + '%'"> </div>
    </div>

    <template x-if="imagePreview">
        <div>
            <img x-bind:src="imagePreview"
                x-bind:width="{{ $attributes->has('width') ? $attributes->get('width') : '400' }}"
                x-bind:height="{{ $attributes->has('height') ? $attributes->get('height') : '320' }}">
        </div>
    </template>

    {{-- @php
        $photo = $attributes->whereStartsWith('wire:model')->first();
    @endphp
    @if ($photo)
        <img
            src="{{ $photo->temporaryUrl() }}" alt="{{ __('Foto nuk gjindet') }}"
            style="
                height: {{ $attributes->has('width') ? $attributes->get('width') + 'px;' : '' }}
                width: {{ $attributes->has('width') ? $attributes->get('width') + 'px;' : '' }}">
    @endif --}}

</div>
