<x-app title="{{ $post->title }}">
    <div class="mt-20 max-w-2xl">
        <a href="/" id="back-link" class="text-sm text-slate-400">{{ '<' }} go back</a>
        <div class="space-y-1">
            <h1 class="text-3xl">{{ $post->title }}</h1>
            <p class="text-sm">posted by <a class="underline" href="/users/{{ $post->user->id }}/profile">{{ $post->user->username }}</a> {{ $post->created_at->diffForHumans() }} ({{ $post->created_at->format('Y/m/d') }})</p>
            <p class="text-sm">posted in <a class="underline" href="/?category={{ $post->category->slug }}">{{ $post->category->name }}</a></p>
            <div class="space-x-3 flex">
                @if(auth()->check() && auth()->user()->role < 3 || auth()->check() && auth()->user()->id == $post->user_id)
                    <label for="delete-post-modal" class="cursor-pointer">
                        <i class="fa-solid fa-trash-can"></i> Delete
                    </label>
                    <label for="edit-post-modal" class="cursor-pointer">
                        <i class="fa-solid fa-edit"></i> Edit
                    </label>
                @endif
            </div>
        </div>
        <div class="border-b border-b-slate-700 my-5"></div>
        <div class="prose prose-invert">
            {!! Str::of($post->body)->markdown() !!}
        </div>
    </div>
    <div class="mt-20 max-w-2xl mx-auto">
        {{-- comment form --}}
        @auth
            <div class="md:flex p-5 bg-base-200 rounded-xl">
                <div class="md:mr-10 flex-shrink-0">
                    <x-profile-icon :user="auth()->user()"
                                    class="rounded-full mx-auto hidden md:inline" />
                </div>
                <div class="w-full">
                    <form method="POST" action="/posts/post/{{ $post->id }}/comment">
                        @csrf

                        <div class="form-control w-full">
                            <label class="label" for="body">
                                <span class="label-text">Post a comment</span>
                            </label>
                            <textarea name="comment-body" id="comment-body" type="text" class="textarea textarea-bordered w-full" rows="3" required>{{ old('comment-body') }}</textarea>
                            <x-validation-error error="comment-body" />
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">
                            <i class="fa-solid fa-plus mr-2"></i> Post Comment
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="p-5 bg-base-200 rounded-xl">
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
    <script>
        const backLink = document.getElementById('back-link');
        backLink.setAttribute('href', document.referrer);
    </script>

    @if(auth()->check() && auth()->user()->role < 3 || auth()->check() && auth()->user()->id == $post->user_id)
        {{-- edit post modal --}}
        <x-modal id="edit-post-modal">
            <h3 class="font-bold text-lg">Edit Post</h3>
            <form method="POST" action="/posts/post/{{ $post->id }}/edit" class="space-y-10 mt-0">
                <div class="form-control w-full">
                    <label class="label" for="title">
                        <span class="label-text">Post Title</span>
                    </label>
                    <input name="title" id="title" type="text" class="input input-bordered w-full"
                           value="{{ $post->title }}"
                           @if(auth()->user()->role == 3)
                           disabled
                           @endif
                           required />
                    <x-validation-error error="title" />
                </div>

                <div class="form-control w-full">
                    <label class="label" for="body">
                        <span class="label-text">Post Body</span>
                    </label>
                    <textarea name="body" id="body" type="text" class="textarea textarea-bordered w-full" rows="8" required>{{ $post->body }}</textarea>
                    <x-validation-error error="body" />
                </div>

                @csrf

                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk mr-2"></i> Edit Post
                </button>
            </form>
        </x-modal>

        <x-modal id="delete-post-modal">
            <form method="POST" action="/posts/post/{{ $post->id }}/delete">
                @csrf
                <h3 class="font-bold text-lg">Delete Post</h3>
                <p>Are you sure you want to delete this post? You can't undo this action.</p>
                <div class="modal-action">
                    <label for="delete-post-modal" class="btn">
                        Cancel
                    </label>
                    <button class="btn btn-error">
                        <i class="fa-solid fa-trash-can mr-2"></i> Delete
                    </button>
                </div>
            </form>
        </x-modal>
    @endif
</x-app>
