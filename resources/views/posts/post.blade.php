<x-app title="{{ $post->title }}">
    <div class="mt-20 max-w-2xl mx-auto">
        <a href="/" class="text-sm text-slate-400">{{ '<' }} go back</a>
        <h1 class="text-3xl">{{ $post->title }}</h1>
        <p class="text-sm">posted by {{ $post->user->username }}</p>
        <p class="text-sm">{{ $post->created_at->diffForHumans() }}</p>
        <div class="border-b border-b-slate-700 my-5"></div>
        <div class="prose prose-invert">
            {!! Str::of($post->body)->markdown() !!}
        </div>
    </div>
</x-app>
