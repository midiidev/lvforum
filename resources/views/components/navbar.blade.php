@php
$nav_items = [
    '<a href="/"><i class="fa-solid fa-house-chimney"></i> Home</a>',
    '<a href="/users"><i class="fa-solid fa-users"></i> Users</a>',
    '<a href="/stats"><i class="fa-solid fa-chart-simple"></i> Stats</a>'
]
@endphp

<nav class="p-4 md:px-10 shadow-lg sticky top-0 backdrop-blur">
    <div class="flex text-lg justify-between">
        <div class="space-x-5 my-auto">
            <span x-data="{ show: false }" id="itemList" class="md:hidden">
                <button class="border border-indigo-600 border-2 rounded px-2" @click="show = !show">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <a href="/" class="md:hidden ml-4 font-bold">{{ env('APP_NAME') }}</a>

                <div x-show="show">
                    <ul class="space-y-2 mt-2">
                        @foreach($nav_items as $item)
                            {!! '<li>' . $item . '</li>' !!}
                        @endforeach
                    </ul>
                </div>
            </span>
            <a href="/" class="hidden md:inline font-bold">{{ env('APP_NAME') }}</a>
            <span class="hidden md:inline space-x-5">
                @foreach($nav_items as $item)
                    {!! $item !!}
                @endforeach
            </span>
        </div>
        <div class="space-x-5 my-auto">
            @auth

            <span class="space-x-5">
                <div x-data="{ show: false }">
                    <button @click="show = !show">
                        {{ auth()->user()->username }}
                    </button>

                    <div x-show="show" class="fixed bg-slate-800 w-40 rounded-xl top-16 right-10">
                        <a href="/users/{{ auth()->user()->id }}/profile" class="block hover:bg-slate-700 rounded-xl p-2">Profile</a>
                        <a href="/settings" class="block hover:bg-slate-700 rounded-xl p-2">Settings</a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit" class="w-full text-left hover:bg-slate-700 rounded-xl p-2">Logout</button>
                        </form>
                    </div>
                </div>
            </span>
            @else
            <span class="space-x-5">
                <a href="/login"><i class="mt-2 fa-solid fa-right-to-bracket"></i> Login</a>
                <a href="/register" class="mt-2 bg-indigo-600 p-2 rounded"><i class="fa-solid fa-user-plus"></i> Register</a>
            </span>
            @endauth
        </div>
    </div>
</nav>

<script>
    window.toggleItems = function(){
        document.getElementById('itemList').__x.$data.show = ! show;
    }
</script>
