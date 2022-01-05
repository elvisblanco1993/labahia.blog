<div>
    <div class="max-w-7xl mx-auto my-6 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between">
            <div class="w-2/3 sm:w-1/3">
                <input type="search" wire:model="query" placeholder="{{__("Search")}}">
            </div>
            @livewire('gallery.upload')
        </div>

        <div class="mt-6">
            <div class="grid grid-cols-6 gap-8">
                @forelse ($images as $image)
                    <div class="col-span-1 h-auto p-2 border rounded-lg bg-white shadow-sm">
                        <img src="{{ asset('images/'.$image->filename) }}" alt="" class="w-full aspect-auto rounded-md shadow-inner object-cover">
                        <div class="mt-2">
                            <span class="flex items-center justify-between">
                                <div>
                                    <button onclick="copyToClipboard('{{ asset('images/'.$image->filename) }}', 'text_{{$image->id}}')" class="flex items-center text-gray-500 hover:text-indigo-500 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                        <span class="text-xs ml-1" id="text_{{$image->id}}">{{__("Copy")}}</span>
                                    </button>
                                </div>
                                @livewire('gallery.delete', ['image' => $image->id])
                            </span>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>
        </div>
    </div>

    {{-- Copy to Clipboard Script --}}
    <script>
        function copyToClipboard(url, id)
        {
            navigator.clipboard.writeText(url);
            document.getElementById(id).innerText = 'Copied';
            setTimeout(() => {  document.getElementById(id).innerText = 'Copy'; }, 2000);
        }
    </script>
</div>
