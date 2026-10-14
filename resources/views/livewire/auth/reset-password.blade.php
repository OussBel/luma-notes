
<div class="flex min-h-screen flex-col items-center justify-center p-8">

    <div class="mb-6 text-center">
        <a href="{{ route('home') }}" wire:navigate>
            <h1 class="text-5xl font-semibold tracking-tight text-slate-900">
                <span class="text-indigo-600">Luma</span> notes
            </h1>
        </a>

        <p class="mt-2 text-sm text-slate-500">
            Choose a new password for your account.
        </p>
    </div>

    <div class="w-full max-w-xl rounded-2xl border border-slate-200
                bg-white p-6 shadow-sm sm:p-8">

        <form wire:submit="resetPassword" class="space-y-5">

            <div>
                <label for="email"
                       class="mb-1.5 block text-sm font-medium text-slate-700">
                    Email address
                </label>
                <input
                    type="email"
                    id="email"
                    wire:model="email"
                    required
                    autocomplete="email"
                    class="w-full rounded-lg border border-slate-300
                           px-3 py-2.5 text-sm outline-none
                           focus:border-indigo-500 focus:ring-2
                           focus:ring-indigo-100"
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password"
                       class="mb-1.5 block text-sm font-medium text-slate-700">
                    New password
                </label>
                <input
                    type="password"
                    id="password"
                    wire:model="password"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-slate-300
                           px-3 py-2.5 text-sm outline-none
                           focus:border-indigo-500 focus:ring-2
                           focus:ring-indigo-100"
                >
                @error('password')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation"
                       class="mb-1.5 block text-sm font-medium text-slate-700">
                    Confirm new password
                </label>
                <input
                    type="password"
                    id="password_confirmation"
                    wire:model="password_confirmation"
                    required
                    autocomplete="new-password"
                    class="w-full rounded-lg border border-slate-300
                           px-3 py-2.5 text-sm outline-none
                           focus:border-indigo-500 focus:ring-2
                           focus:ring-indigo-100"
                >
            </div>

            <button
                type="submit"
                wire:loading.attr="disabled"
                class="w-full rounded-lg bg-indigo-700 px-5 py-2.5
                       text-sm font-medium text-white transition
                       hover:bg-indigo-600 disabled:opacity-50"
            >
                <span wire:loading.remove wire:target="resetPassword">
                    Reset password
                </span>
                <span wire:loading wire:target="resetPassword">
                    Resetting...
                </span>
            </button>
        </form>

        <p class="mt-5 text-center text-sm text-slate-500">
            <a href="{{ route('login') }}" wire:navigate
               class="font-medium text-indigo-700 hover:text-indigo-600">
                Back to sign in
            </a>
        </p>
    </div>
</div>
