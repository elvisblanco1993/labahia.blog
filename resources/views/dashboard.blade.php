<x-app-layout>
    @if (Auth::user()->isAdmin())
        @livewire('dashboard.admin')
    @else
        @livewire('dashboard.writer')
    @endif
</x-app-layout>
