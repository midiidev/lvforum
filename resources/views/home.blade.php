<x-app title="Home">
    <div class="mt-20 max-w-7xl mx-auto space-y-6">
        @if(!isset($category))
            <div>
                <h1 class="text-4xl text-center">All Posts</h1>
            </div>
        @else
            <div>
                <h1 class="text-4xl text-center">{{ $category->name }}</h1>
                <p class="text-slate-400 text-center">{{ $category->description }}</p>
            </div>
        @endif
        @auth
            @if(isset($category))
                <p class="text-right">
                    <label for="create-post-modal" class="btn btn-primary">
                        <i class="fa-solid fa-plus mr-2"></i> Create Post
                    </label>
                </p>
            @else
                <p class="text-right">
                    <span class="btn btn-primary">
                        <i class="fa-solid fa-plus mr-2"></i> Go to a category to create a post.
                    </span>
                </p>
            @endif
        @endauth
        <div class="md:grid grid-cols-4 gap-10">
            <div class="rounded-xl hover:cursor-pointer mb-auto row-end-auto bg-base-200 rounded-xl divide-y divide-base-100">
                <div>
                    <a href="/" class="block p-5 text-xl hover:bg-base-100/50">
                        <i class="fa-solid fa-comment fa-fw"></i> All Posts
                    </a>
                </div>
                @foreach($categories as $pcategory)
                    <div>
                        <a href="/?category={{ $pcategory->slug }}" class="block p-5 text-xl hover:bg-base-100/50">
                            <i class="{{ $pcategory->icon }} fa-fw"></i> {{ $pcategory->name }}
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="col-span-3 space-y-5 mt-5 md:mt-0">
                @foreach($posts as $post)
                    <div class="card card-body bg-base-200 hover:cursor-pointer">
                        <a href="/posts/post/{{ $post->id }}">
                            <h2 class="text-2xl font-semibold">{{ $post->title }}</h2>
                            <p class="text-sm mb-3">by {{ $post->user->username }}</p>
                            <style>
                                {{-- hide images from the home page --}}
                                img {
                                    display: none;
                                }
                            </style>
                            <p>{!! Str::of($post->body)->limit(300, '...')->markdown() !!}</p>
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
                @endforeach
                @if($posts->count() == 0)
                    <div class="space-y-4">
                        <h1 class="text-2xl">We're sorry :(</h1>
                        <p>there are no posts yet, but you can change that!</p>
                    </div>
                @endif

                <div class="mt-20">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- create post modal --}}
    @if(isset($category))
        <x-modal id="create-post-modal">
            <h3 class="font-bold text-lg">Create Post</h3>
            <form method="POST" action="/create-post" class="space-y-10 mt-0">
                <div class="form-control w-full">
                    <label class="label" for="title">
                        <span class="label-text">Post Title</span>
                    </label>
                    <input name="title" id="title" type="text" class="input input-bordered w-full" value="{{ old('title') }}" required />
                    <x-validation-error error="title" />
                </div>

                <p>Category: <b>{{ $category->name }}</b></p>

                <div class="form-control w-full">
                    <label class="label" for="body">
                        <span class="label-text">Post Body</span>
                    </label>
                    <textarea name="body" id="body" type="text" class="textarea textarea-bordered w-full" rows="8" required>{{ old('body') }}</textarea>
                    <x-validation-error error="body" />
                </div>

                @csrf

                <input name="category_id" id="category_id" value="{{ $category->id }}" hidden>

                <div class="modal-action">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-file-pen mr-2"></i> Create Post
                    </button>
                </div>
            </form>
        </x-modal>
    @endif
</x-app>
