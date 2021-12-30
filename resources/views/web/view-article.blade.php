@extends('layouts.article')
@section('article')
{{-- Menu --}}
@include('layouts.navbar')

{{-- <div id="fb-root"></div> --}}
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v12.0" nonce="op9yg6sp"></script>

{{-- Content --}}
<div class="max-w-3xl mx-auto my-12 px-4 sm:px-6 lg:px-8 article">
    <div class="text-center">
        <h2 class="text-4xl mb-4 font-black text-gray-900 dark:text-white">{{$article->title}}</h2>
        <div class="text-sm text-gray-600 dark:text-gray-200 font-sans">
            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->published_at)->formatLocalized('%d de %B %Y') . ' - ' . $read_time . ' ' . __("min read")  }}
        </div>
        <div class="block my-4">
            @forelse ($article->tags as $tag)
                <a href="{{ route('tags.filter', ['tag' => $tag->slug]) }}" class="article text-sm px-2 py-1 mr-1 bg-indigo-100 text-indigo-600 rounded-md hover:bg-indigo-200 hover:text-indigo-800 transition">#{{ $tag->slug }}</a>
            @empty
            @endforelse
        </div>
    </div>
    <img src="{{asset('images/'.$article->image)}}" alt="" class="mt-4 w-full max-h-96 object-cover object-center rounded-md">
    <div class="mt-6 prose prose-indigo dark:text-gray-400 min-w-full article">
        {!! Str::of($article->body)->markdown() !!}
    </div>
    <div class="mt-6 border dark:border-gray-600 rounded-md p-4 flex items-center text-sm text-light">
        <img class="w-20 h-20 rounded-full object-cover" src="{{$article->user->profile_photo_url}}" alt="{{$article->user->name}}">
        <div class="ml-4">
            <div class="text-base text-gray-700 dark:text-gray-300">{{__("By:")}} <a class="font-bold" href="{{route('author.filter', ['user' => $article->user->id])}}">{{$article->user->name}}</a></div>
            @if(isset($article->user->bio))
                <div class="mt-1 text-sm text-gray-600 dark:text-gray-400">{{$article->user->bio}}</div>
            @endif
            @if(isset($article->user->donation_link))
                <div class="mt-1 text-xs text-blue-600"><a href="{{$article->user->donation_link}}">{{__("Support the author")}}</a></div>
            @endif
        </div>
    </div>

    <div class="block mt-6">
        <div    class="fb-share-button"
                data-href="{{url()->current()}}"
                data-layout="button"
                data-size="large">
            <a
                target="_blank"
                href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}"
                class="fb-xfbml-parse-ignore">Share</a>
        </div>
    </div>
</div>
@if ($article->comments)
    @include('layouts.disqus')
@endif
@endsection

