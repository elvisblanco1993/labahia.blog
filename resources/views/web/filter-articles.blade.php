<x-guest-layout>
    @include('layouts.navbar')
    <div class="max-w-3xl mx-auto">
        {{-- Content --}}
        <div class="my-12 px-4 sm:px-6 lg:px-8">
            <div class="mb-12">
                <h1 class="text-3xl font-bold">{{ $title }}</h1>
            </div>
            <div class="grid grid-cols-3 gap-8">
                @forelse ($articles as $article)
                <a href="{{route('articles.view', ['article' => $article->slug])}}" class="col-span-3 rounded-lg border p-4 hover:shadow hover:transform hover:-translate-y-1 transition-all">
                    <div class="block h-post-card-image bg-cover bg-center bg-no-repeat w-full h-48 mb-5" style="background-image: url('{{asset('images/'.$article->image)}}')"></div>
                    <div class="flex flex-col justify-between">
                        <div class="article-card">
                            <h2 class="leading-normal block mb-6 text-xl font-bold">{{$article->title}}</h2>
                            <p class="leading-normal mb-6">
                                {{ Str::limit(strip_tags(Str::of($article->body)->markdown), 150, '...') }}
                            </p>
                        </div>
                        <div class="flex items-center text-sm text-light">
                            <img class="w-10 h-10 rounded-full object-cover" src="{{$article->user->profile_photo_url}}" alt="{{$article->user->name}}">
                            <span class="ml-2">{{$article->user->name}}</span>
                            <span class="ml-auto">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->published_at)->formatLocalized('%d de %B %Y') }}</span>
                        </div>
                    </div>
                </a>
                @empty

                @endforelse
            </div>
        </div>
    </div>
</x-guest-layouit>
