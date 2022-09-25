<x-app title="Admin Panel">
    <div class="mt-20 max-w-2xl mx-auto space-y-6">
        <div class="space-y-5">
            <h1 class="text-4xl">Admin Panel</h1>
            <div class="border-b border-b-slate-700"></div>
            <div class="md:inline-grid grid-cols-2 gap-2 space-y-5">
                <div>
                    <h2 class="text-2xl">Change Role</h2>
                    <p>Change the role of a user.</p>
                    <code class="text-sm">0: root, can do basically anything</code><br>
                    <code class="text-sm">1: admin, can access this panel and most things in it, only assigned by root</code><br>
                    <code class="text-sm">2: mod, able to delete posts and comments</code><br>
                    <code class="text-sm">3: user, able to create posts and comments</code>
                </div>
                <div>
                    <form method="POST" action="/admin/change-role" class="space-y-5">
                        <div class="form-control w-full">
                            <label class="label" for="username">
                                <span class="label-text">Username</span>
                            </label>
                            <input name="username" id="username" type="text" class="input input-bordered w-full" value="{{ old('username') }}" required />
                            <x-validation-error error="username" />
                        </div>

                        <div class="form-control w-full">
                            <label class="label" for="new_role">
                                <span class="label-text">New Role</span>
                            </label>
                            <select name="new_role" id="new_role" class="select select-bordered w-full">
                                <option value="0" disabled>0: Root</option>
                                @if(auth()->user()->role < 1)
                                    <option value="1">1: Admin</option>
                                @else
                                    <option value="1" disabled>1: Admin</option>
                                @endif
                                <option value="2">2: Mod</option>
                                <option value="3">3: User</option>
                            </select>
                            <x-validation-error error="new_role" />
                        </div>

                        @csrf

                        <button type="submit" class="btn btn-primary">Change Role</button>
                    </form>
                </div>

                <div>
                    <h2 class="text-2xl">Check Role</h2>
                    <p>Check the role of a user.</p>
                    @if(session()->has('role'))
                        <p class="font-semibold mt-3">{{ session('role') }}</p>
                    @endif
                </div>
                <div>
                    <form method="POST" action="/admin/check-role" class="space-y-5">
                        <div class="form-control w-full">
                            <label class="label" for="username">
                                <span class="label-text">Username</span>
                            </label>
                            <input name="username" id="username" type="text" class="input input-bordered w-full" value="{{ old('username') }}" required />
                            <x-validation-error error="username" />
                        </div>

                        @csrf

                        <button type="submit" class="btn btn-primary">Check Role</button>
                    </form>
                </div>

                <div>
                    <h2 class="text-2xl">Change Default Profile Picture</h2>
                    <div class="flex flex-col items-left justify-left mt-2">
                        <form method="POST" action="/admin/change-default-icon" enctype="multipart/form-data">
                            <label for="icon" class="flex items-left justify-left">
                                <span class="btn btn-accent cursor-pointer">
                                    <i class="fa-solid fa-image mr-2"></i> Choose a file
                                </span>
                            </label>
                            <input name="icon" id="icon" type="file" class="hidden">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">Upload</button>
                        </form>
                        <x-validation-error error="icon" />
                    </div>
                </div>
                <div>
                    <x-profile-icon alt="default profile picture"
                                    class="rounded-full mx-auto"
                                    size="150"
                    />
                </div>

                <div>
                    <h2 class="text-2xl">Ban User</h2>
                    <p>Ban a user.</p>
                    <p>You can set a user's ban time to 0 to unban them.</p>
                </div>
                <div>
                    <form method="POST" action="/admin/ban-user" class="space-y-5">
                        <div class="form-control w-full">
                            <label class="label" for="username">
                                <span class="label-text">Username</span>
                            </label>
                            <input name="username" id="username" type="text" class="input input-bordered w-full" value="{{ old('username') }}" required />
                            <x-validation-error error="username" />
                        </div>
                        <div class="form-control w-full">
                            <label class="label" for="time">
                                <span class="label-text">Ban time (in days)</span>
                            </label>
                            <input name="time" id="time" type="number" class="input input-bordered w-full" value="{{ old('time') }}" required />
                            <x-validation-error error="time" />
                        </div>

                        @csrf

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-ban mr-2"></i> Ban User
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
