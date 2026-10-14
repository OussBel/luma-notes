<div class="flex min-h-screen flex-col items-center justify-center p-8">

    <div class="mb-6 text-center">
        <a href="{{ route('home') }}" wire:navigate class="inline-block rounded-lg transition hover:opacity-80">
            <h1 class="text-5xl font-semibold tracking-tight text-slate-900">
                <span class="text-indigo-600">Luma</span> notes
            </h1>
        </a>

        <p class="mt-2 text-sm text-slate-500">
            Reset your password to get back to your board.
        </p>
    </div>

    <div class="w-full max-w-xl rounded-2xl border border-slate-200
                bg-white p-6 shadow-sm sm:p-8">

        @if (session('status'))
            <div class="mb-5 rounded-lg bg-green-50 p-3 text-sm text-green-700">
                {{ session('status') }}
            </div>
        @endif

        <form wire:submit="sendResetLink" class="space-y-5">
            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Email address
                </label>

                <input type="email" id="email" wire:model="email" placeholder="you@example.com" required
                    autocomplete="email"
                    class="w-full rounded-lg border border-slate-300 bg-white
                           px-3 py-2.5 text-sm text-slate-800 outline-none
                           transition focus:border-indigo-500
                           focus:ring-2 focus:ring-indigo-100">

                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit" wire:loading.attr="disabled"
                class="w-full rounded-lg bg-indigo-700 px-5 py-2.5
                       text-sm font-medium text-white transition
                       hover:bg-indigo-600 disabled:opacity-50">
                <span wire:loading.remove wire:target="sendResetLink">
                    Send reset link
                </span>
                <span wire:loading wire:target="sendResetLink">
                    Sending...
                </span>
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-500">
            Remember your password?
            <a href="{{ route('login') }}" wire:navigate class="font-medium text-indigo-700 hover:text-indigo-600">
                Sign in
            </a>
        </p>
    </div>

    <p class="mt-6 text-center text-xs text-slate-400">
        Manage your tasks. Stay organized.
    </p>
</div>
