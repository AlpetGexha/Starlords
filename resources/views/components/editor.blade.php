<div class="mt-2 bg-white" wire:ignore>
    <div x-data x-ref="quillEditor" x-init="quill = new Quill($refs.quillEditor, {
        debug: 'info',
        placeholder: 'Write something...',
        theme: 'snow'
    });
    quill.on('text-change', function() {
        $dispatch('input', quill.root.innerHTML);
    });" {{ $attributes }}>
        {{-- {!! $slot !!} --}}
    </div>
</div>
