@props(['width' => 50, 'height' => 'auto'])

<div class="text-center edit-img-on-click" x-data="{
    imagePreview: '{!! $attributes->has('src') ? $attributes->get('src') : '' !!}'
}">
    <input type="file" class="" style="display: none" {{ $attributes->whereStartsWith('wire:model') }}
        x-ref="image_input"
        x-on:change="
            reader = new FileReader();
            reader.onload = (event) => {
                imagePreview = event.target.result;
                {{-- document.getElementById('profileImage').src = `${imagePreview}`; --}}
            };
            reader.readAsDataURL($refs.image_input.files[0]);
        " />
    <img style="width: {{ $width }}px; height: {{ $height }}px" x-on:click="$refs.image_input.click()"
        x-bind:src="imagePreview ? imagePreview : 'https://cutewallpaper.org/24/no-image-png/2331832352.jpg'"
        class="{{ $attributes->has('class') ? $attributes->get('class') : '' }}"
        loading="lazy"
        alt="No Image Found Here">
</div>

@push('styles')
    @once
        <style>
            .edit-img-on-click img {
                cursor: pointer;
            }

            .edit-img-on-click img:hover {
                border: 2px solid #000;
                border-radius: 10px;
            }
        </style>
    @endonce
@endpush
