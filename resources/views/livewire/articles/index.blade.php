<div>
    <div class="max-w-7xl mx-auto my-6 px-4 sm:px-6 lg:px-8">

        <div class="flex items-center justify-between">
            <div class="w-2/3 sm:w-1/3">
                <input type="search" wire:model="query" placeholder="{{__("Search")}}">
            </div>
            <div class="">
                <a href="{{ route('articles.create') }}" class="primary-button">
                    {{__("Create")}}
                </a>
            </div>
        </div>

        <div class="flex flex-col mt-6">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Title")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Last updated")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Status")}}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        {{__("Written by")}}
                                    </th>
                                    <th scope="col" class="relative px-6 py-3">
                                        <span class="sr-only">{{__("Actions")}}</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($articles as $article)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded object-cover" src="{{asset('images/'.$article->image)}}">
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">
                                                        {{ $article->title }}
                                                    </div>
                                                    <div class="text-sm text-gray-500 underline">
                                                        <a target="_blank" href="{{ route('articles.view', ['article' => $article->slug]) }}">{{ $article->slug }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                {{ date('d-m-Y H:i:s', strtotime($article->updated_at)) }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (isset($article->published_at))
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    {{__("Published")}}
                                                </span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                    {{__("Draft")}}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{$article->user->name}}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-4">
                                            <a href="{{route('articles.publish', ['article'=>$article->id])}}" class="text-indigo-600 hover:text-indigo-900">
                                                @if (isset($article->published_at))
                                                {{__("Unpublish")}}
                                                @else
                                                {{__("Publish")}}
                                                @endif
                                            </a>
                                            <a href="{{route('articles.edit', ['article' => $article->id])}}" class="text-indigo-600 hover:text-indigo-900">{{__("Edit")}}</a>
                                            @if ($article->trashed())
                                                <a href="{{route('articles.restore', ['article' => $article->id])}}" class="text-green-600 hover:text-green-900">{{__("Restore")}}</a>
                                            @else
                                                <a href="{{route('articles.delete', ['article' => $article->id])}}" class="text-red-600 hover:text-red-900">{{__("Delete")}}</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="w-full mt-4">
                @if ($articles->count() > 0)
                    {{ $articles->links() }}
                @endif
            </div>
        </div>
    </div>
</div>
