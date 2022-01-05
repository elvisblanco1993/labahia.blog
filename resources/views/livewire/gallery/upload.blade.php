<div>
    <button wire:click="$toggle('uploadModal')" class="primary-button">
        {{__("Upload")}}
    </button>

    <x-jet-dialog-modal wire:model="uploadModal">
        <x-slot name="title">{{__("Upload images")}}</x-slot>
        <x-slot name="content">
            <input type="file" wire:model="images" multiple class="block w-full file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            @error('images.*') <span class="text-sm">{{ $message }}</span> @enderror
        </x-slot>
        <x-slot name="footer">
            <button wire:click="save" class="primary-button">{{__("Save Images")}}</button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
