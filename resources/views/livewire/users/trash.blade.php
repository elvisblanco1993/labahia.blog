<div>
    <button wire:click="$toggle('deleteUser')" class="text-sm text-red-600 hover:text-red-900">{{__("Delete")}}</button>

    <x-jet-dialog-modal wire:model="deleteUser">
        <x-slot name="title">{{__("Delete User")}}</x-slot>
        <x-slot name="content">
            {{__("Are you sure you want to delete this user? You can always restore it from the trashed users section.")}}
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('deleteUser')">{{__("Nevermind")}}</x-jet-secondary-button>
            <x-jet-danger-button wire:click="trash" class="ml-4">{{__("Delete User")}}</x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
