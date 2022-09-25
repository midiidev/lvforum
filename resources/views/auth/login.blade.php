<x-app title="Login">
    <h1 class="mt-20 text-3xl text-center">Log In</h1>

    <div class="max-w-xl mx-auto mt-10 panel p-5">
        <form method="POST" class="space-y-10 mt-0">
            <div class="form-control w-full">
                <label class="label" for="email">
                    <span class="label-text">Email</span>
                </label>
                <input name="email" id="email" type="email" class="input input-bordered w-full" value="{{ old('email') }}" required />
                @error('email')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-control w-full">
                <label class="label" for="password">
                    <span class="label-text">Password</span>
                </label>
                <input name="password" id="password" type="password" class="input input-bordered w-full" required />
                @error('password')
                <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            @csrf

            <button type="submit" class="btn btn-primary">Log In</button>
        </form>
    </div>
</x-app>
