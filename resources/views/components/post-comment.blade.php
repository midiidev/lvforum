@props(['comment'])

<div class="md:flex p-5 bg-slate-800 rounded-xl">
    <div class="md:mr-10 flex-shrink-0">
        <x-profile-icon :user="$comment->user"
                        class="rounded-full mx-auto hidden md:inline" />
    </div>
    <div>
        <p class="text-sm">
            Posted by <a href="/users/{{ $comment->user->id }}/profile" class="font-semibold">{{ $comment->user->username }}</a> | {{ $comment->created_at->diffForHumans() }} ({{ $comment->created_at->format('Y/m/d') }})
        </p>
        <p class="mt-2">
            {{ $comment->body }}
        </p>
    </div>
</div>
