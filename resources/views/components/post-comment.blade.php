@props(['comment'])

<div class="md:flex p-5 bg-base-200 rounded-xl">
    <div class="md:mr-10 flex-shrink-0">
        <x-profile-icon :user="$comment->user"
                        class="rounded-full mx-auto hidden md:inline" />
    </div>
    <div>
        <p class="text-sm">
            Posted by <a href="/users/{{ $comment->user->id }}/profile" class="font-semibold">{{ $comment->user->username }}</a> | {{ $comment->created_at->diffForHumans() }} ({{ $comment->created_at->format('Y/m/d') }})
        </p>
        @if(auth()->check() && auth()->user()->role < 3 || auth()->check() && auth()->user()->id == $comment->user_id)
            <form method="POST" action="/posts/comments/{{ $comment->id }}/delete">
                @csrf
                <button>
                    <i class="fa-solid fa-trash-can"></i> Delete
                </button>
            </form>
        @endif
        <div class="prose prose-invert">
            <style>
                img {
                    display: none;
                }
            </style>
            {!! Str::of($comment->body)->markdown() !!}
        </div>
    </div>
</div>
