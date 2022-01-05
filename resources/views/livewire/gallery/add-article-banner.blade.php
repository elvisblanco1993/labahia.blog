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
            <div class="grid grid-cols-4 gap-4">
                @forelse ($images as $image)
                    <div class="col-span-4 sm:col-span-2 md:col-span-1">
                        <input type="radio" name="image" id="image_option_{{$image['id']}}" wire:model="selectedImage" value="{{$image['filename']}}" class="sr-only peer">
                        <label for="image_option_{{$image['id']}}" class="flex p-2 bg-white border border-gray-300 rounded-lg cursor-pointer focus:outline-none hover:bg-gray-50 peer-checked:ring-indigo-500 peer-checked:ring-2 peer-checked:border-transparent">
                            <img src="{{ asset('images/'.$image['filename']) }}" alt="" class="w-full aspect-square object-cover">
                        </label>
                    </div>
                @empty

                @endforelse
            </div>
            @error('selectedImage')
                <small class="mt-1 text-red-600">{{$message}}</small>
            @enderror
        </x-slot>
        <x-slot name="footer" class="gap-4">
            <x-jet-secondary-button wire:click="$toggle('addBannerModal')">{{__("Dismiss")}}</x-jet-secondary-button>
            <button wire:click="addBanner"
                class="primary-button">
                {{__("Add banner")}}
            </button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
