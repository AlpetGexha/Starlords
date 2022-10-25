@props(['count'])
<div
    x-data="{ temp: {{ $attributes->has('rate') ? $attributes->get('rate') : '' }}, orig: null }"
        {{ $attributes->merge(['class' => 'flex text-2xl']) }}>
    <template x-for="item in [1, 2, 3, 4, 5]">
        <span type="submit"
            class="text-gray-300 cursor-pointer"
            :class="{ 'text-yellow-300': (temp >= item) }">★</span>
    </template>
   @if (isset($count))
        <span class="text-sm text-center pt-1 ml-1 ">({{ $count }})</span>
   @endif
</div>
