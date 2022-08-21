<x-app title="Create Post">
    <h1 class="mt-20 text-4xl text-center">Edit Post</h1>

    <div class="max-w-4xl mx-auto mt-10 border border-slate-700 bg-slate-800 rounded-xl p-5">
        <form method="POST" action="/posts/post/{{ $post->id }}/edit" class="space-y-10 mt-0">
            <div>
                <label for="title" class="block font-bold">Post Title</label>
                <input name="title"
                       id="title"
                       type="text"
                       value="{{ $post->title }}"
                       @if(auth()->user()->role == 3)
                       disabled
                       @endif
                       class="<x-input />"
                       required
                >
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block font-bold">Post Body</label>
                <textarea name="body" id="body" class="<x-input />" rows="10" required>{{ $post->body }}</textarea>
                @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @csrf

            <button type="submit" class="<x-button />">Update Post</button>
        </form>
    </div>
</x-app>
