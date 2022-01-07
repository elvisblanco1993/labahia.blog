<div>
    <form wire:submit.prevent="saveComment">
        @csrf
        <div class="grid grid-cols-2 gap-8">
            <div class="col-span-2 sm:col-span-1">
                <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{__("Name")}}</label>
                <input type="text" id="name" wire:model="author" class="mt-1">
                @error('author')
                    <span class="text-sm text-red-600">{{ __($message) }}</span>
                @enderror
            </div>
            <div class="col-span-2 sm:col-span-1">
                <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{__("Email")}}</label>
                <input type="email" id="email" wire:model="email" class="mt-1">
                @error('email')
                    <span class="text-sm text-red-600">{{ __($message) }}</span>
                @enderror
            </div>
            <div class="col-span-2">
                <label for="comment" class="block font-medium text-sm text-gray-700 dark:text-gray-300">{{__("Comment")}}</label>
                <textarea id="comment" wire:model="content" cols="30" rows="5" class="mt-1"></textarea>
                @error('content')
                    <span class="text-sm text-red-600">{{ __($message) }}</span>
                @enderror
            </div>
            <div class="col-span-2">
                <x-jet-button type="submit">{{__("Send comment")}}</x-jet-button>
            </div>
        </div>
    </form>
</div>
