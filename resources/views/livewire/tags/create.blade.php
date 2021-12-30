<div>
    <div class="flex items-center justify-between">
        <div class="w-2/3">
            <input type="text" wire:model="name" placeholder="Tag" class="text-sm" autofocus>
        </div>
        <x-jet-button wire:click="create">{{__("Create")}}</x-jet-button>
    </div>
</div>
