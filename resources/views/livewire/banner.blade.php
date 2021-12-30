<div>
    <button
        wire:click="$toggle('addBannerModal')"
        class="hidden sm:flex text-xs uppercase font-semibold tracking-widest text-gray-600 hover:text-indigo-600 transition-all">
        {{__("banner")}}
            @if ($article->image)
                <span class="text-green-500">&checkmark;</span>
            @endif
    </button>
    <x-jet-dialog-modal wire:model="addBannerModal">
        <x-slot name="title">{{__("Add banner")}}</x-slot>
        <x-slot name="content">

            @if (isset($article->image))
                <div class="block h-post-card-image bg-cover bg-center bg-no-repeat w-full h-48" style="background-image: url('{{asset('images/'.$article->image)}}')"></div>
                <div class="text-sm text-gray-500">{{__("Your banner will look similar to this when the article is published.")}}</div>
            @endif

            <div class="mt-6 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>{{__("Upload a file")}}</span>
                            <input id="file-upload" wire:model="image" type="file" accept=".jpeg, .png, .jpg" class="sr-only">
                        </label>
                        <p class="pl-1">{{__("or drag and drop")}}</p>
                    </div>
                    <p class="text-xs text-gray-500">{{__("PNG, JPG, WEBP up to 2MB")}}</p>
                </div>
            </div>
            @error('image')
                <small class="mt-1 text-red-600">{{$message}}</small>
            @enderror
        </x-slot>
        <x-slot name="footer" class="gap-4">
            <x-jet-secondary-button wire:click="$toggle('addBannerModal')">{{__("Dismiss")}}</x-jet-secondary-button>
            <button wire:click="uploadImage"
                class="primary-button">
                {{__("Add banner")}}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
