<x-app title="{{ $user->username }}'s profile" description="{{ $user->bio }}">
    <div class="mt-20 max-w-5xl mx-auto space-y-6">
        <div>
            <h1 class="text-4xl text-center">{{ $user->username }}'s profile</h1>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            <div class="col-span-1">
                <div class="card bg-base-200">
                    <x-profile-icon :user="$user" class="w-full" />
                    <div class="card-body">
                        @if($user->bio != null)
                            <p>{!! nl2br(htmlspecialchars($user->bio)) !!}</p>
                        @else
                            <p><i>This user has not set anything to display here yet...</i></p>
                        @endif
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
