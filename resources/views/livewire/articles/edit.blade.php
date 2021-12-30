<div>
    <div class="px-4 sm:px-6 lg:px-8 py-4 flex items-center justify-between bg-white border-b">
        <div class="">
            <a href="{{ route('articles') }}">
                <div class="group flex items-center text-sm transform text-gray-600 hover:text-red-600 transition-all">
                    <span class="group-hover:-translate-x-1 transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </span>
                    <span class="text-xs uppercase font-semibold text-gray-600 tracking-widest group-hover:text-red-600">{{__("Back")}}</span>
                </div>
            </a>
        </div>
        <div class="flex items-center gap-8">
            <div class="text-sm text-right text-gray-400">
                {{$wordCount . ' ' . __("words")}}
            </div>
            <div class="flex items-center gap-3">
                <button
                    wire:click="$toggle('addTagsModal')"
                    class="hidden sm:flex text-xs uppercase font-semibold tracking-widest text-gray-600 hover:text-indigo-600 transition-all">
                    {{__("tags")}}
                        @if(count($article->tags) > 0) <span class="text-green-500">&checkmark;</span> @endif()
                </button>
                @livewire('banner', ['article_id' => $article->id])
                <button wire:click="setComments"
                    class="hidden sm:flex text-xs uppercase font-semibold tracking-widest text-gray-600 hover:text-indigo-600 transition-all">
                    @if ($article->comments == 0)
                        {{__("Enable comments")}}
                    @else
                        {{__("Disable comments")}}
                    @endif
                </button>
            </div>
            <button class="primary-button" wire:click="update">
                {{__("Save")}}
            </button>
        </div>
    </div>

    <x-jet-dialog-modal wire:model="addTagsModal">
        <x-slot name="title">{{__("Add tags to your article.")}}</x-slot>
        <x-slot name="content">
            {{-- TODO --}}

            @livewire('tags.create', ['article' => $article->id])

            <div class="mt-6 font-bold text-lg border-b">{{__("Used Tags")}}</div>
            @forelse ($activeTags as $tag)
                <div class="w-full flex items-center justify-between border-b border-gray-100 p-2 hover:bg-gray-100 transition-all">
                    <span>{{$tag->name}}</span>
                    <span>
                        <button wire:click="detachTag({{$tag->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </div>
            @empty
                <div class="text-center text-sm text-gray-500 p-2">{{__("Add some tags by clicking the '+' sign next to the tags below, or create your own above.")}}</div>
            @endforelse

            <div class="mt-6 font-bold text-lg border-b">{{__("Available Tags")}}</div>
            @forelse ($availableTags as $tag)
                <div class="w-full flex items-center justify-between border-b border-gray-100 p-2 hover:bg-gray-100 transition-all">
                    <span>{{$tag->name}}</span>
                    <span>
                        <button wire:click="attachTag({{$tag->id}})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </span>
                </div>
            @empty
                <div class="text-center text-sm text-gray-500 p-2">{{__("You have used all the available tags.")}}</div>
            @endforelse

            {{-- TODO END --}}
        </x-slot>
        <x-slot name="footer" class="space-x-4">
            <x-jet-secondary-button wire:click="$toggle('addTagsModal')">{{__("Done")}}</x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 mt-4">
        <div class="flex items-center justify-between mb-4 pb-4">
            <div class="w-full">
                <input type="text" class="w-full border-none shadow-none text-2xl text-black font-bold @error('title') placeholder-red-600 @enderror" wire:model.defer="title" placeholder="{{__("Title")}}">
            </div>
        </div>
        <textarea wire:model="body" id="editor" class="w-full border-none text-md text-gray-800  @error('title') placeholder-red-600 @enderror" placeholder="{{__("Write")}}..." autofocus="true" rows='28'></textarea>
    </div>
</div>
