@php
    $input = 'bg-slate-700 border border-slate-600 rounded w-full p-2';
@endphp

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
                        <div>
                            <label for="username" class="block font-bold">Username</label>
                            <input name="username"
                                   id="username"
                                   type="text"
                                   class="{{ $input }}"
                                   required>
                            @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="new_role" class="block font-bold">New Role</label>
                            <select name="new_role" id="new_role" class="{{ $input }}">
                                <option value="0" disabled>0: Root</option>
                                @if(auth()->user()->role < 1)
                                    <option value="1">1: Admin</option>
                                @else
                                    <option value="1" disabled>1: Admin</option>
                                @endif
                                <option value="2">2: Mod</option>
                                <option value="3">3: User</option>
                            </select>
                            @error('new_password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @csrf

                        <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 rounded">Change Role</button>
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
                        <div>
                            <label for="username" class="block font-bold">Username</label>
                            <input name="username"
                                   id="username"
                                   type="text"
                                   class="{{ $input }}"
                                   required>
                            @error('username')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        @csrf

                        <button type="submit" class="p-2 bg-indigo-600 hover:bg-indigo-700 rounded">Check Role</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app>
