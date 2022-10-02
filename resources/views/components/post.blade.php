<div class="rounded-2xl bg-base-200 hover:cursor-pointer">
    <a href="/posts/post/{{ $post->id }}" class="card card-body hover:bg-base-100/50">
        <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
        <p class="text-sm mb-3">by {{ $post->user->username }}</p>
        <p>{!! nl2br(Str::of($post->body)->limit(300, '...')) !!}</p>
        {{-- find a better way to do this later --}}
        @if($post->comments->last() != null) {{-- if there are comments --}}
        <p class="text-sm mt-3">
            {{ $post->created_at->diffForHumans() }} | Last comment {{ $post->comments->last()->created_at->diffForHumans() }} {{-- this is ugly, but it works --}}
        </p>
        @else {{-- if there are no comments --}}
        <p class="text-sm mt-3">
            {{ $post->created_at->diffForHumans() }}
        </p>
        @endif
    </a>
</div>
