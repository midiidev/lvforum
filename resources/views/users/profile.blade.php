<x-app title="{{ $user->username }}'s profile" description="{{ $user->bio }}">
    <div class="mt-20 max-w-5xl mx-auto space-y-6">
        <div>
            <h1 class="text-4xl text-center">{{ $user->username }}'s profile</h1>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            <div class="col-span-1">
                <div class="card bg-base-200">
                    <x-profile-icon :user="$user" class="w-full" />
                    <div class="card-body" x-init x-data="{ showEdit: false }">
                        <form method="POST" action="/settings/change-bio">
                            @if($user->bio != null)
                                <p x-show="!showEdit">{!! nl2br(htmlspecialchars($user->bio)) !!}</p>
                                @if(auth()->check() && auth()->user()->id == $user->id)
                                    <textarea x-show="showEdit" class="textarea textarea-bordered" name="bio">{{ $user->bio ?? '' }}</textarea>
                                    <x-validation-error error="bio" />
                                @endif
                            @else
                                <p x-show="!showEdit"><i>This user has not set anything to display here yet...</i></p>
                                @if(auth()->check() && auth()->user()->id == $user->id)
                                    <textarea x-show="showEdit" class="textarea textarea-bordered" name="bio">{{ $user->bio ?? '' }}</textarea>
                                    <x-validation-error error="bio" />
                                @endif
                            @endif
                            <div class="flex space-x-2">
                                @if(auth()->check() && auth()->user()->id == $user->id)
                                    <label x-show="!showEdit" @click="showEdit = !showEdit" class="cursor-pointer">
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </label>
                                    @csrf
                                    <button x-show="showEdit" class="cursor-pointer">
                                        <i class="fa-solid fa-floppy-disk"></i> Save
                                    </button>
                                    <label x-show="showEdit" @click="showEdit = !showEdit" class="cursor-pointer">
                                        <i class="fa-solid fa-xmark"></i> Cancel
                                    </label>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <div class="mt-5 card card-body bg-base-200">
                    <table>
                        <tr>
                            <td>Posts: </td>
                            <td class="text-right">{{ $postCount }}</td>
                        </tr>
                        <tr>
                            <td>Comments: </td>
                            <td class="text-right">{{ $commentCount }}</td>
                        </tr>
                        <tr>
                            <td>Join Date: </td>
                            <td class="text-right">{{ $user->created_at->format('Y/m/d') }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="md:col-span-2 space-y-5">
                <h3 class="text-2xl">{{ $user->username }}'s recent posts</h3>
                @foreach($recent as $post)
                    <x-post :post="$post" />
                @endforeach
            </div>
        </div>
    </div>
</x-app>
