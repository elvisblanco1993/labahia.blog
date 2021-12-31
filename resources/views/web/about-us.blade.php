<x-guest-layout>
    @include('layouts.navbar')
    <div class="max-w-3xl mx-auto my-12 px-4 sm:px-6 lg:px-8 article">
        <div class="text-center">
            <h2 class="text-4xl mb-4 font-black text-gray-900 dark:text-white">{{__("What is La Bahia?")}}</h2>
        </div>
        <div class="mt-6 prose-xl prose-indigo dark:text-gray-400 min-w-full article">
            {{__("La Bahia is a community project focused on unearthing and preserving lost stories of the towns of Cuba. We also comment in current issues and take a stand against social injustice by the island's regime and its followers towards the ones who seek a better Cuba free from communism and misery.")}}
        </div>
    </div>
</x-guest-layout>

