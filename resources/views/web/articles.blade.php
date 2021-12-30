<x-guest-layout>
    {{-- Menu --}}
    @include('layouts.navbar')
    <div class="max-w-7xl mx-auto">

        {{-- Content --}}
        <div class="my-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-6 gap-8 sm:gap-14">

                @forelse ($articles as $article)
                    @if ($loop->first)
                        <div class="hidden sm:block col-span-6 w-full">
                            <div class="grid grid-cols-4 h-96">
                                <div class="col-span-2 h-full w-full">
                                    <img src="{{asset('images/'.$article->image)}}" alt="{{$article->title}}" class="w-full h-96 object-cover object-center">
                                </div>
                                <div class="col-span-2 w-full h-full flex flex-col items-center justify-center bg-black text-white text-center p-6">
                                    <h1 class="text-2xl md:text-4xl font-semibold dark:text-gray-400 transition-all">{{$article->title}}</h1>
                                    <div class="flex items-center gap-4 mt-4">
                                        <a href="{{route('author.filter', ['user' => $article->user->id])}}" class="text-sm transition-all">
                                            {{ __("By:") . ' ' . $article->user->name }}
                                        </a>
                                        <span>&centerdot;</span>
                                        <div class="text-sm-transition-all">
                                            {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->published_at)->formatLocalized('%d de %B %Y') }}
                                        </div>
                                    </div>
                                    <a href="{{ route('articles.view', ['article' => $article->slug]) }}" class="mt-4 border-b border-gray-400 hover:text-black hover:bg-white p-4 flex items-center gap-2 transition-all">
                                        <span>{{__("Read article")}}</span>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('articles.view', ['article' => $article->slug]) }}" class="sm:hidden col-span-6 sm:col-span-2 group">
                            <div class="h-56 w-full block bg-center bg-cover" style="background-image: url('{{asset('images/'.$article->image)}}')"></div>
                            <div class="w-full mt-4 flex items-center justify-between dark:text-gray-500">
                                <div class="text-sm group-hover:text-indigo-500 transition-all">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->published_at)->formatLocalized('%d de %B %Y') }}
                                </div>
                                <div class="text-sm group-hover:text-indigo-500 transition-all">
                                    {{ __("By: ") . $article->user->name }}
                                </div>
                            </div>
                            <div class="mt-3 font-semibold text-gray-800 dark:text-gray-400 group-hover:text-indigo-500 transition-all">{{$article->title}}</div>
                        </a>

                        @else

                        <a href="{{ route('articles.view', ['article' => $article->slug]) }}" class="col-span-6 sm:col-span-2 group">
                            <div class="h-56 w-full block bg-center bg-cover" style="background-image: url('{{asset('images/'.$article->image)}}')"></div>
                            <div class="w-full mt-4 flex items-center justify-between dark:text-gray-500">
                                <div class="text-sm group-hover:text-indigo-500 transition-all">
                                    {{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $article->published_at)->formatLocalized('%d de %B %Y') }}
                                </div>
                                <div class="text-sm group-hover:text-indigo-500 transition-all">
                                    {{ __("By: ") . $article->user->name }}
                                </div>
                            </div>
                            <div class="mt-3 font-semibold text-gray-800 dark:text-gray-400 group-hover:text-indigo-500 transition-all">{{$article->title}}</div>
                        </a>
                    @endif
                @empty

                @endforelse

                <div class="col-span-6">
                    {{$articles->links()}}
                </div>
            </div>

        </div>
    </div>

</x-guest-layouit>
