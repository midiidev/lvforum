<x-app title="Home">
    <div class="mt-20 max-w-7xl mx-auto space-y-6">
        @if(!isset($category))
            <h1 class="text-4xl text-center">All Posts</h1>
        @else
            <h1 class="text-4xl text-center">{{ $category->name }}</h1>
        @endif
        @auth
            @if(isset($category))
                <p class="text-right">
                    <a href="/create-post/category/{{ $category->id }}" class="bg-indigo-600 p-4 rounded-xl">
                        <i class="fa-solid fa-plus"></i> Create Post
                    </a>
                </p>
            @else
                <p class="text-right">
                    <span class="bg-indigo-600 p-4 rounded-xl">
                        <i class="fa-solid fa-plus"></i> Go to a category to create a post.
                    </span>
                </p>
            @endif
        @endauth
        <div class="md:grid grid-cols-3 gap-10">
            <div class="bg-slate-800 rounded-xl hover:cursor-pointer mb-auto row-end-auto">
                <div class="hover:bg-slate-700 p-5 hover:cursor-pointer hover:rounded-t-xl">
                    <a href="/">
                        <h2 class="text-xl"><i class="fa-solid fa-comment"></i> All Posts</h2>
                    </a>
                </div>
                <div class="mx-auto border-b border-b-slate-700 w-10/12"></div>
                @foreach($categories as $postCategory)
                    {{-- adds hover: rounding differently depending on if the category --}}
                    {{-- is first, last, or neither --}}
                    <div class="hover:bg-slate-700 p-5 hover:cursor-pointer <?php if($loop->last){echo 'hover:rounded-b-xl';} ?>"> {{-- i know this is ugly, but it works --}}
                        <a href="/posts/{{ $postCategory->slug }}">
                            <h2 class="text-xl"><i class="{{ $postCategory->icon }}"></i> {{ $postCategory->name }}</h2>
                        </a>
                    </div>
                    @unless($loop->last)
                        <div class="mx-auto border-b border-b-slate-700 w-10/12"></div>
                    @endunless
                @endforeach
            </div>
            <div class="col-span-2 space-y-5 mt-5 md:mt-0">
                @foreach($posts as $post)
                    <div class="bg-slate-800 hover:bg-slate-700 rounded-xl p-5 hover:cursor-pointer">
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
        </div>
    </div>
</x-app>
