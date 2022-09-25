<x-app title="Register">
    <h1 class="mt-20 text-3xl text-center">Register</h1>

    <div class="max-w-xl mx-auto mt-10 panel p-5">
        <form method="POST" class="space-y-10 mt-0">
            <div class="form-control w-full">
                <label class="label" for="username">
                    <span class="label-text">Username</span>
                </label>
                <input name="username" id="username" type="text" class="input input-bordered w-full" value="{{ old('username') }}" required />
                <x-validation-error error="username" />
            </div>

            <div class="form-control w-full">
                <label class="label" for="email">
                    <span class="label-text">Email</span>
                </label>
                <input name="email" id="email" type="email" class="input input-bordered w-full" value="{{ old('email') }}" required />
                <x-validation-error error="email" />
            </div>

            <div class="form-control w-full">
                <label class="label" for="password">
                    <span class="label-text">Password</span>
                </label>
                <input name="password" id="password" type="password" class="input input-bordered w-full" required />
                <x-validation-error error="password" />
            </div>

            <div class="form-control w-full">
                <label class="label" for="password_confirmation">
                    <span class="label-text">Confirm Password</span>
                </label>
                <input name="password_confirmation" id="password_confirmation" type="password" class="input input-bordered w-full" required />
            </div>

            @csrf

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
</x-app>
