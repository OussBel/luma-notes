<div class="flex flex-col items-center justify-center p-8 min-h-screen">
    @if (session('success'))
        <div id="flash" class="p-4 text-center bg-green-50 text-green-500">
            {{ session('success') }}
        </div>
    @endif
    <div class="mb-6 text-center">
        <a href="{{ route('home') }}" wire:navigate class="inline-block rounded-lg transition hover:opacity-80">
            <h1 class="text-5xl font-semibold tracking-tight text-slate-900">
                <span class="text-indigo-600">Luma</span> notes
            </h1>
        </a>

        <p class="mt-1 text-sm text-slate-500">
            Sign in to continue to your board.
        </p>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8 w-full max-w-xl">
        <form wire:submit="authenticate" class="space-y-5">
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Email address
                </label>

                <input type="email" id="email" wire:model="email" placeholder="you@example.com"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm
                     text-slate-800 placeholder:text-slate-400 outline-none transition
                      focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
            </div>

            <div>
                <div class="mb-1.5 flex items-center justify-between">
                    <label for="password" class="block text-sm font-medium text-slate-700">
                        Password
                    </label>
                    <a href="{{ route('password.request') }}" wire:navigate
                        class="text-xs font-medium text-indigo-700
                     hover:text-indigo-600">
                        Forgot password?
                    </a>
                </div>

                <input type="password" id="password" wire:model="password" placeholder="Enter your password"
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-800
                     placeholder:text-slate-400 outline-none transition focus:border-indigo-500 focus:ring-2
                      focus:ring-indigo-100">
            </div>

            <div class="flex items-center">
                <input type="checkbox" id="remember" name="remember" wire:model="remember"
                    class="size-4 rounded border-slate-300 text-indigo-700 focus:ring-indigo-500">

                <label for="remember" class="ml-2 text-sm text-slate-600">
                    Remember me
                </label>
            </div>

            <button type="submit"
                class="w-full cursor-pointer rounded-lg bg-indigo-700 px-5 py-2.5 text-sm font-medium
                 text-white transition-colors duration-200 hover:bg-indigo-600 focus:outline-none 
                 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Sign in
            </button>
            <p class="text-center text-red-500">
                @error('email')
                    {{ $message }}
                @enderror
            </p>
        </form>

        <div class="text-center">
            <p class="text-sm text-slate-500">
                Don't have an account?
                <a href="{{ route('register') }}" wire:navigate
                    class="font-medium text-indigo-700 hover:text-indigo-600">
                    Create an account
                </a>
            </p>
        </div>

    </div>

    <p class="mt-6 text-center text-xs text-slate-400">
        Manage your tasks. Stay organized.
    </p>

</div>
