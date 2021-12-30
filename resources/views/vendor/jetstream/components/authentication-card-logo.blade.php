<div class="text-center">
    <div class="text-xl lg:text-4xl font-black text-black tracking-wide bg-yellow-300 px-4 py-1" id="logo">
        la bahia
    </div>

    @if (request()->routeIs('login'))
        <div class="mt-6 text-lg font-bold text-gray-600 dark:text-gray-200">
            {{__("Welcome back!")}}
        </div>
    @endif
</div>
