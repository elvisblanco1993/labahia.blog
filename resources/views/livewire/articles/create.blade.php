<div>
    <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between bg-white border-b">
        <div class="">
            <a href="{{ route('articles') }}">
                <div class="group flex items-center text-sm transform hover:text-red-600 transition-all">
                    <span class="group-hover:-translate-x-1 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="text-xs uppercase group-hover:text-red-600">{{__("Back")}}</span>
                </div>
            </a>
        </div>
        <div class="flex items-center gap-8">
            <div class="text-sm text-right text-gray-400">
                {{$wordCount . ' ' . __("words")}}
            </div>
            <span class="text-sm text-gray-600 tracking-wide">{{__("Please save your work to add banners and tags.")}}</span>
            <button class="primary-button" wire:click="create">
                {{__("Save")}}
            </button>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-0 mt-4">
        <div class="flex items-center justify-between mb-4 pb-4">
            <div class="w-full">
                <input type="text" class="w-full border-none shadow-none text-2xl text-black font-bold @error('title') placeholder-red-600 @enderror" wire:model.defer="title" placeholder="{{__("Title")}}" autofocus>
            </div>
        </div>
        <textarea wire:model="body" id="editor" class="w-full border-none text-md text-black  @error('title') placeholder-red-600 @enderror" placeholder="{{__("Write")}}..." rows='26'></textarea>
    </div>
</div>
