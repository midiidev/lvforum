<x-app title="Settings">
    <div class="mt-20 max-w-2xl mx-auto space-y-6">
        <div class="space-y-5">
            <h1 class="text-4xl">Account Settings</h1>
            <div class="border-b border-b-slate-700"></div>
            <div class="md:inline-grid grid-cols-2 gap-2 w-full">
                <div>
                    <h2 class="text-2xl">Change Profile Picture</h2>
                    <div class="flex flex-col items-left justify-left mt-2">
                        <form method="POST" action="/settings/change-icon" enctype="multipart/form-data" class="flex space-x-3">
                            <label for="icon" class="flex items-left justify-left">
                                <span class="btn btn-accent">
                                    <i class="fa-solid fa-image mr-2"></i> Choose a file
                                </span>
                            </label>
                            <input name="icon" id="icon" type="file" class="hidden">
                            @csrf
                            <button type="submit" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk mr-2"></i> Save
                            </button>
                        </form>
                        @error('icon')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div>
                    <x-profile-icon :user="auth()->user()"
                                    alt="{{ auth()->user()->username }}"
                                    class="rounded-full mx-auto"
                                    size="150"
                    />
                </div>
            </div>

            <div class="md:inline-grid grid-cols-2 gap-2">
                <div>
                    <h2 class="text-2xl">Change Password</h2>
                    <p>
                        You should make your password not obvious and unique. <a href="https://bitwarden.com/" class="underline">Password managers</a> are very useful.
                    </p>
                </div>
                <div>
                    <form method="POST" action="/settings/change-password" class="space-y-5">
                        <div class="form-control w-full">
                            <label class="label" for="current_password">
                                <span class="label-text">Current Password</span>
                            </label>
                            <input name="current_password" id="current_password" type="password" class="input input-bordered w-full" required />
                            <x-validation-error error="current_password" />
                        </div>
                        <div class="form-control w-full">
                            <label class="label" for="new_password">
                                <span class="label-text">New Password</span>
                            </label>
                            <input name="new_password" id="new_password" type="password" class="input input-bordered w-full" required />
                            <x-validation-error error="new_password" />
                        </div>
                        <div class="form-control w-full">
                            <label class="label" for="new_password_confirmation">
                                <span class="label-text">Confirm New Password</span>
                            </label>
                            <input name="new_password_confirmation" id="new_password_confirmation" type="password" class="input input-bordered w-full" required />
                        </div>

                        @csrf

                        <button type="submit" class="btn btn-primary">
                            <i class="fa-solid fa-floppy-disk mr-2"></i> Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
