<x-app title="Home">
    <div class="mt-20 max-w-2xl mx-auto space-y-6">
        <p class="text-right">
            <a href="/create-post" class="bg-indigo-600 p-4 rounded-xl"><i class="fa-solid fa-plus"></i> Create Post</a>
        </p>
        @foreach($posts as $post)
            <div class="bg-slate-800 active:bg-slate-700 rounded-xl p-5 hover:cursor-pointer">
                <a href="/posts/{{ $post->id }}">
                    <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
                    <p>{{ Str::of($post->body)->limit(300, '...') }}</p>
                </a>
            </div>
        @endforeach
    </div>
</x-app>
