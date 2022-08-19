<x-app title="Settings">
    <div class="mt-20 max-w-2xl mx-auto space-y-6">
        <div class="space-y-5">
            <h1 class="text-4xl">Account Settings</h1>
            <div class="border-b border-b-slate-700"></div>
            <div class="md:inline-grid grid-cols-2 gap-2">
                <div>
                    <h2 class="text-2xl">Change Profile Picture</h2>
                    <p>
                        Links and base64 encoded images are supported.
                    </p>
                </div>
                <div>
                    <form method="POST" action="/settings/change-icon" class="space-y-5">
                        <div>
                            <input name="icon"
                                   id="icon"
                                   type="text"
                                   class="<x-input />"
                            >
                            @error('icon')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @csrf

                        <button type="submit" class="<x-button />">Change Icon</button>
                    </form>
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
                        <div>
                            <label for="current_password" class="block font-bold">Current Password</label>
                            <input name="current_password"
                                   id="current_password"
                                   type="password"
                                   class="<x-input />"
                                   required>
                            @error('current_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password" class="block font-bold">New Password</label>
                            <input name="new_password"
                                   id="new_password"
                                   type="password"
                                   class="<x-input />"
                                   required>
                            @error('new_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="block font-bold">Confirm New Password</label>
                            <input name="new_password_confirmation"
                                   id="new_password_confirmation"
                                   type="password"
                                   class="<x-input />"
                                   required>
                        </div>

                        @csrf

                        <button type="submit" class="<x-button />">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
