<div>
    @forelse ($comments as $comment)
        @if (!$loop->first)
            <div class="border-t border-gray-300"></div>
        @endif
        <div class="grid grid-cols-3 gap-2 my-4">
            <div class="col-span-3 sm:col-span-1">
                <p class="text-indigo-600 font-bold">{{ $comment->author . ' ' . __("said:") }}</p>
                <small>{{ date('d/m/Y h:i a', strtotime($comment->created_at)) }}</small>
            </div>
            <div class="col-span-3 sm:col-span-2 text-base">{{ $comment->content }}</div>
        </div>
    @empty
        <p class="w-full text-center">{{__("Be the first to comment.")}}</p>
    @endforelse
</div>
