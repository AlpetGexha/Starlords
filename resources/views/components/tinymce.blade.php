<div>
    <script src="https://cdn.tiny.cloud/1/{{ env('TINY_EDITOR') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        .tox-notifications-container {
            display: none !important;
        }
    </style>
    <div class="mt-5 ">
        <div wire:ignore>
            <textarea {{ $attributes->whereStartsWith('wire:model') }}>
            {{--  --}}
        </textarea>
        </div>
    </div>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: [
                'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
                'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
                'insertdatetime', 'media', 'table', 'help', 'wordcount'
            ],
            toolbar: 'undo redo | blocks | ' +
                'bold italic backcolor | alignleft aligncenter ' +
                'alignright alignjustify | bullist numlist outdent indent | ' +
                'removeformat | help |',
            toolbar_mode: 'floating',
            setup: function(editor) {
                editor.on('init change', function() {
                    editor.save();
                });
                editor.on('change', function(e) {
                    @this.set('{{ $attributes->wire('model')->value() }}', editor.getContent());
                });
            }
        });
    </script>
</div>
