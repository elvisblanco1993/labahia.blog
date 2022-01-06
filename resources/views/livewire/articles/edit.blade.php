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
                @livewire('gallery.add-article-banner', ['article_id' => $article->id])
                <button wire:click="setComments"
                    class="hidden sm:flex text-xs uppercase font-semibold tracking-widest text-gray-600 hover:text-indigo-600 transition-all">
                    @if ($article->comments == 0)
                        {{__("Enable comments")}}
                    @else
                        {{__("Disable comments")}}
                    @endif
                </button>
            </div>
            <button  wire:click="$toggle('preview')" class="text-gray-600">
                @if ($preview == TRUE)
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                        <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                        <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                    </svg>
                @endif
            </button>
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

    <div class="max-w-3xl mx-auto px-4 sm:px-0 mt-4">
        @if ($preview == TRUE)
            <div class="prose prose-lg prose-blue">
                {!! Str::of($article->body)->markdown() !!}
            </div>
        @else
            <div class="flex items-center justify-between mb-4 pb-4">
                <div class="w-full">
                    <input type="text" class="w-full border-none shadow-none text-2xl text-black font-bold @error('title') placeholder-red-600 @enderror" wire:model.defer="title" placeholder="{{__("Title")}}" autofocus>
                </div>
            </div>
            <textarea wire:model="body" id="editor" class="w-full border-none text-md text-black  @error('title') placeholder-red-600 @enderror" placeholder="{{__("Write")}}..." rows='26'></textarea>
        @endif
    </div>
</div>
