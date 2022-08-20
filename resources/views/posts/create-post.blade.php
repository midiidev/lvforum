<x-app title="Create Post">
    <h1 class="mt-20 text-4xl text-center">Create Post</h1>

    <div class="max-w-4xl mx-auto mt-10 border border-slate-700 bg-slate-800 rounded-xl p-5">
        <form method="POST" action="/create-post" class="space-y-10 mt-0">
            <div>
                <label for="title" class="block font-bold">Post Title</label>
                <input name="title"
                       id="title"
                       type="text"
                       value="{{ old('title') }}"
                       class="<x-input />"
                       required>
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <p>Category: <b>{{ $category->name }}</b></p>

            <div>
                <label for="body" class="block font-bold">Post Body</label>
                <textarea name="body" id="body" class="<x-input />" rows="10" required></textarea>
                @error('body')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @csrf

            <input name="category_id" id="category_id" value="{{ $category->id }}" hidden>

            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 rounded">Create Post</button>
        </form>
    </div>
</x-app>
