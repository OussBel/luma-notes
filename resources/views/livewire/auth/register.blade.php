<div class="min-h-screen bg-slate-50 flex flex-col items-center justify-center px-4 py-12">

    <div class="w-full max-w-xl">

        <div class="mb-6 text-center">
            <a href="{{ route('home') }}" wire:navigate class="inline-block rounded-lg transition hover:opacity-80">
                <h1 class="text-5xl font-semibold tracking-tight text-slate-900">
                    <span class="text-indigo-600">Luma</span> notes
                </h1>
            </a>
            <p class="mt-1 text-sm text-slate-500">
                Start organizing your thoughts with Luma Notes.
            </p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-8 shadow-sm sm:p-10">
            <form wire:submit="register" class="space-y-5">
                <div>
                    <label for="email" class="mb-2 text-sm block font-medium text-slate-700">
                        Name
                    </label>
                    <input id="name" wire:model="name" type="name" placeholder="Name"
                        class="w-full rounded-lg text-sm border border-slate-300 bg-white px-4 py-3.5
                         text-slate-800 placeholder:text-slate-400 outline-none transition 
                         focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <p class="text-red-500 text-sm">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div>
                    <label for="email" class="mb-2 block text-sm font-medium text-slate-700">
                        Email address
                    </label>
                    <input id="email" wire:model="email" type="email" placeholder="you@example.com"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm
                         text-slate-800 placeholder:text-slate-400 outline-none transition
                          focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    <p class="text-red-500 text-sm">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div>
                    <label for="password" class="mb-2 block text-sm font-medium text-slate-700">
                        Password
                    </label>

                    <input id="password" type="password" wire:model="password" placeholder="Enter your password"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm
                         text-slate-800 placeholder:text-slate-400 outline-none transition
                          focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                    <p class="mt-2 text-sm text-slate-400">
                        Must be at least 8 characters.
                    </p>
                    <p class="text-red-500 text-sm">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </p>
                </div>

                <div>
                    <label for="password_confirmation" class="mb-2 block text-sm font-medium text-slate-700">
                        Confirm password
                    </label>

                    <input id="password_confirmation" wire:model="password_confirmation" type="password"
                        placeholder="Re-enter your password"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 
                        text-sm text-slate-800 placeholder:text-slate-400 outline-none transition
                         focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                </div>
                <button type="submit"
                    class="w-full cursor-pointer rounded-lg bg-indigo-600 px-5 py-2.5
                     text-base font-medium text-white transition-colors duration-200
                      hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                    Create account
                </button>
            </form>

            <div class="text-center mt-5">
                <p class="text-sm text-slate-500">
                    Already have an account?
                    <a href="{{ route('login') }}" wire:navigate
                        class="ml-1 font-medium text-indigo-600 hover:text-indigo-500">
                        Sign in
                    </a>
                </p>
            </div>
        </div>
        <p class="mt-8 text-center text-sm leading-6 text-slate-400">
            By creating an account, you agree to our
            <a href="#" class="text-indigo-600 underline hover:text-indigo-500">
                Terms
            </a>
            and
            <a href="#" class="text-indigo-600 underline hover:text-indigo-500">
                Privacy Policy
            </a>.
        </p>
    </div>
</div>
