<button wire:loading.attr='disabled'
    {{ $attributes->merge(['type' => 'submit', 'class' => 'ml-3 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-sky-500 hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sky-500']) }}>
    {{ $slot }}
</button>
