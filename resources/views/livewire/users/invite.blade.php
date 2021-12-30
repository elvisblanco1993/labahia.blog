<div>
    <button class="primary-button" wire:click="$toggle('inviteUserModal')">
        {{__("Invite")}}
    </button>

    <x-jet-dialog-modal wire:model="inviteUserModal">
        <x-slot name="title">
            {{__("Invite User")}}
        </x-slot>
        <x-slot name="content">
            <div class="mt-6">
                <label for="name" class="block font-medium text-sm text-gray-700">{{__("Name")}}</label>
                <input id="name" type="text" wire:model="name" class="mt-1" placeholder="John Smith">
                @error('name') <span class="text-sm text-red-600">{{ __($message) }}</span> @enderror
            </div>
            <div class="mt-6">
                <label for="email" class="block font-medium text-sm text-gray-700">{{__("Email")}}</label>
                <input id="email" type="email" wire:model="email" class="mt-1" placeholder="email@domain.com">
                @error('email') <span class="text-sm text-red-600">{{ __($message) }}</span> @enderror
            </div>
            <div class="mt-6">
                <label for="role" class="block font-medium text-sm text-gray-700">{{__("Role")}}</label>
                <select wire:model="role" id="role" class="mt-1">
                    <option></option>
                    <option value="admin">{{__("Administrator")}}</option>
                    <option value="user" selected>{{__("User")}}</option>
                </select>
                @error('role') <span class="text-sm text-red-600">{{ __($message) }}</span> @enderror
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('inviteUserModal')" wire:loading.attr="disabled">
                {{__("Nevermind")}}
            </x-jet-secondary-button>
            <button type="submit" wire:click="invite" class="primary-button ml-4">{{__("Invite")}}</button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
