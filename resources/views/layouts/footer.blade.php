<div class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-4 flex items-center justify-center gap-4 text-white">
            <a href="{{route('about')}}" class="text-sm">{{__("About Us")}}</a>
            <span>&centerdot;</span>
            <a href="{{route('policy.show')}}" class="text-sm">{{__("Privacy Policy")}}</a>
            <span>&centerdot;</span>
            <a href="{{route('tips.create')}}" class="text-sm">{{__("Send News")}}</a>
            <span>&centerdot;</span>
            @auth
                <a href="{{ route('dashboard') }}" class="text-sm">{{__("Dashboard")}}</a>
            @else
                <a href="{{ route('login') }}" class="text-sm">{{__("Log in")}}</a>
            @endauth
        </div>
    </div>
</div>
