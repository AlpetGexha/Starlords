<div x-data="{
    isEditing: false,
    isName: '{{ $isName }}',
    focus: function() {
        const textInput = this.$refs.textInput;
        textInput.focus();
        textInput.select();
    }
}" x-cloak>
    <div x-show="!isEditing" x-on:click="isEditing = true; $nextTick(() => focus())">
        <span style="text-decoration: underline;" class="inline-edit">
            {{ $origName }}
        </span>
    </div>

    <div x-show="isEditing" class="">
        <form class="" wire:submit.prevent="save">
            <x-input shadowless wire:model.lazy="newName" x-ref="textInput" x-on:keydown.enter="isEditing = false"
                x-on:keydown.escape="isEditing = false" />

            <div class="flex">
                <x-button xs dark type="button" title="Cancel" x-on:click="isEditing = false">
                    {{ __('Cancel') }}
                </x-button>

                <x-button xs primary type="submit" title="Save" x-on:click="isEditing = false">
                    {{ __('Save') }}
                </x-button>
            </div>
        </form>
        <small class="text-muted">{{ __('Enter to save, Esc to cancel') }}</small>
    </div>
    @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</div>
