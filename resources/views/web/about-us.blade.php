<x-guest-layout>
    @include('layouts.navbar')
    <div class="max-w-3xl mx-auto my-12 px-4 sm:px-6 lg:px-8 article">
        <div class="text-center">
            <h2 class="text-4xl mb-4 font-black text-gray-900 dark:text-white">{{__("What is La Bahia?")}}</h2>
        </div>
        <div class="mt-6 prose prose-indigo dark:text-gray-400 min-w-full article">
            {{__("La Bahía is a community project initially developed by Elvis Blanco, with the purpose of recovering and publicly exposing the lost stories of our island. If you are interested in joining our community of writers, please contact us by writing to")}} <a href="mailto:hola@labahia.blog">hola@labahia.blog</a>
        </div>
    </div>
</x-guest-layout>

