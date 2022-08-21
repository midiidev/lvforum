<x-app title="{{ $post->title }}">
    <div class="mt-20 max-w-2xl mx-auto">
        <a href="/" class="text-sm text-slate-400">{{ '<' }} go back</a>
        <h1 class="text-3xl">{{ $post->title }}</h1>
        <p class="text-sm">posted by {{ $post->user->username }}</p>
        <p class="text-sm">{{ $post->created_at->diffForHumans() }}</p>
        <div class="space-x-3 flex">
            @if(auth()->check() && auth()->user()->role < 3 || auth()->check() && auth()->user()->id == $post->user_id)
                <form method="POST" action="/posts/post/{{ $post->id }}/delete">
                    @csrf
                    <button>
                        <i class="fa-solid fa-trash-can"></i> Delete
                    </button>
                </form>
                <a href="/posts/post/{{ $post->id }}/edit">
                    <i class="fa-solid fa-edit"></i> Edit
                </a>
            @endif
        </div>
        <div class="border-b border-b-slate-700 my-5"></div>
        <div class="prose prose-invert">
            {!! Str::of($post->body)->markdown() !!}
        </div>
    </div>
    <div class="mt-20 max-w-2xl mx-auto">
        {{-- comment form --}}
        @auth
            <div class="md:flex p-5 bg-slate-800 rounded-xl">
                <div class="md:mr-10 flex-shrink-0">
                    <x-profile-icon :user="auth()->user()"
                                    class="rounded-full mx-auto hidden md:inline" />
                </div>
                <div>
                    <form method="POST" action="/posts/post/{{ $post->id }}/comment">
                        @csrf

                        <label for="comment-body" class="font-semibold">Post a comment</label>
                        <textarea name="comment-body"
                                  id="comment-body"
                                  class="<x-input /> mt-2"
                                  rows="3"
                                  required></textarea>
                        <button type="submit" class="<x-button /> mt-2">Post comment</button>
                        @error('comment-body')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
        @else
            <div class="p-5 bg-slate-800 rounded-xl">
                <div>
                    <h3 class="font-semibold text-xl">Want to post a comment?</h3>
                    <p><a href="/register" class="underline">Create an account</a> or <a href="/login" class="underline">log in</a> to start posting comments.</p>
                </div>
            </div>
        @endauth

        {{-- comments --}}
        <div class="mt-5 space-y-5">
            @foreach($post->comments->sortByDesc('id') as $comment)
                <x-post-comment :comment="$comment" />
            @endforeach
        </div>
    </div>
</x-app>
