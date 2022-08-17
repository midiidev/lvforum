@php
    $input = 'bg-slate-700 border border-slate-600 rounded w-full p-2';
@endphp

<x-app title="Create Post">
    <h1 class="mt-20 text-4xl text-center">Create Post</h1>

    <div class="max-w-4xl mx-auto mt-10 border border-slate-700 bg-slate-800 rounded-xl p-5">
        <form method="POST" class="space-y-10 mt-0">
            <div>
                <label for="title" class="block font-bold">Post Title</label>
                <input name="title"
                       id="title"
                       type="text"
                       value="{{ old('title') }}"
                       class="{{ $input }}"
                       required>
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="body" class="block font-bold">Post Body</label>
                <textarea name="body" id="body" class="{{ $input }}" rows="10" required></textarea>
                @error('textarea')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @csrf

            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 rounded">Create Post</button>
        </form>
    </div>
</x-app>
