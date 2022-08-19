<x-app title="Register">
    <h1 class="mt-20 text-3xl text-center">Register</h1>

    <div class="max-w-xl mx-auto mt-10 border border-slate-700 bg-slate-800 rounded-xl p-5">
        <form method="POST" class="space-y-10 mt-0">
            <div>
                <label for="username" class="block font-bold">Username</label>
                <input name="username"
                       id="username"
                       type="text"
                       value="{{ old('username') }}"
                       class="<x-input />"
                       required>
                @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block font-bold">Email</label>
                <input name="email"
                       id="email"
                       type="email"
                       value="{{ old('email') }}"
                       class="<x-input />"
                       required>
                @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-bold">Password</label>
                <input name="password"
                       id="password"
                       type="password"
                       class="<x-input />"
                       required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block font-bold">Confirm Password</label>
                <input name="password_confirmation"
                       id="password_confirmation"
                       type="password"
                       class="<x-input />"
                       required>
            </div>

            @csrf

            <button type="submit" class="<x-button />">Register</button>
        </form>
    </div>
</x-app>
