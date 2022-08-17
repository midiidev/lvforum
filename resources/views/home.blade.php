<x-app title="Home">
    <div class="mt-20 max-w-2xl mx-auto space-y-6">
        @auth
        <p class="text-right">
            <a href="/create-post" class="bg-indigo-600 p-4 rounded-xl"><i class="fa-solid fa-plus"></i> Create Post</a>
        </p>
        @endauth
        @foreach($posts as $post)
            <div class="bg-slate-800 active:bg-slate-700 rounded-xl p-5 hover:cursor-pointer">
                <a href="/posts/{{ $post->id }}">
                    <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
                    <p class="text-sm mb-3">by {{ $post->user->username }}</p>
                    <p>{!! Str::of($post->body)->limit(300, '...')->markdown() !!}</p>
                    <p class="text-sm mt-3">{{ $post->created_at->diffForHumans() }}</p>
                </a>
            </div>
        @endforeach
        @if(\App\Models\Post::count() == 0)
        <div class="space-y-4 text-slate-500">
            <h1 class="text-2xl">We're sorry :(</h1>
            <p>there are no posts yet, but you can change that!</p>
        </div>
        @endif
    </div>
</x-app>
