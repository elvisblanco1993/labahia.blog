<div>
    @forelse ($tips as $tip)
        @if (!$loop->first)
            <div class="border-t border-gray-300"></div>
        @endif
        <div class="grid grid-cols-3 gap-2 my-4">
            <div class="col-span-3 sm:col-span-1">
                <p class="text-indigo-600 font-bold">{{ $tip->name . ' ' . __("said:") }}</p>
            </div>
            <div class="col-span-3 sm:col-span-2 text-base">{{ $tip->message }}</div>
        </div>
    @empty
    @endforelse
</div>
