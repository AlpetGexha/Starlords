@props(['name', 'color', 'table' => null, 'model' => null])

<div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 shadow relative">
    @if (isset($svg))
        <div
            class="p-3 mr-4 text-{{ $color }}-500 bg-{{ $color }}-100 rounded-full dark:text-{{ $color }}-100 dark:bg-{{ $color }}-500">
            {{ $svg }}
        </div>
    @endif
    <livewire:admin.stats :name='$name' :model='$model' :table='$table'>
</div>
