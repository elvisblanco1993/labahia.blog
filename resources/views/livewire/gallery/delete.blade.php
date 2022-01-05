<div>
    <button wire:click="$toggle('deleteImageModal')" class="text-gray-500 hover:text-red-500 transition-all">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
        </svg>
    </button>
    <x-jet-confirmation-modal wire:model="deleteImageModal">
        <x-slot name="title">
            {{__("Delete Image")}}
        </x-slot>

        <x-slot name="content">
            {{__("Are you sure you want to delete this image? Once you delete this image, it cannot be recovered.")}}
        </x-slot>

        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteImageModal')" wire:loading.attr="disabled">
                {{__("Nevermind")}}
            </x-jet-secondary-button>

            <x-jet-danger-button class="ml-2" wire:click="deleteImage" wire:loading.attr="disabled">
                {{__("Delete Image")}}
            </x-jet-danger-button>
        </x-slot>
    </x-jet-confirmation-modal>

</div>
