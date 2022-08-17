@php
    $input = 'bg-slate-700 border border-slate-600 rounded w-full p-2';
@endphp

<x-app title="Register">
    <h1 class="mt-20 text-3xl text-center">Log In</h1>

    <div class="max-w-xl mx-auto mt-10 border border-slate-700 bg-slate-800 rounded-xl p-5">
        <form method="POST" class="space-y-10 mt-0">
            <div>
                <label for="username" class="block font-bold">Username</label>
                <input name="username"
                       id="username"
                       type="text"
                       value="{{ old('username') }}"
                       class="{{ $input }}"
                       required>
                @error('username')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block font-bold">Password</label>
                <input name="password"
                       id="password"
                       type="password"
                       class="{{ $input }}"
                       required>
                @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @csrf

            <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 rounded">Log In</button>
        </form>
    </div>
</x-app>
