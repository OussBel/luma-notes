<div class="mb-8 flex flex-col items-start justify-between gap-4 sm:flex-row">
    <div>
        <a href="{{ route('home') }}" wire:navigate class="inline-block rounded-lg transition hover:opacity-80">
            <h1 class="text-5xl font-semibold tracking-tight text-slate-900">
                <span class="text-indigo-600">Luma</span> notes
            </h1>
        </a>

        <p class="mt-2 text-sm text-slate-600 sm:text-base">
            Keep track of what happens to your notes.
        </p>
    </div>

    <button type="button" wire:click="refreshActivities" wire:loading.attr="disabled" wire:target="refreshActivities"
        aria-label="Refresh activities" title="Refresh activities"
        class="flex h-12 w-12 items-center justify-center rounded-2xl
               bg-indigo-100 text-2xl text-indigo-700 transition
               hover:bg-indigo-200 focus:outline-none focus:ring-2
               focus:ring-indigo-500 focus:ring-offset-2
               disabled:cursor-wait disabled:opacity-60">
        <span wire:loading.remove wire:target="refreshActivities">↻</span>

        <svg wire:loading wire:target="refreshActivities" class="h-6 w-6 animate-spin"
            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" />
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
        </svg>
    </button>
</div>

<a href="{{ route('board') }}" wire:navigate
    class="group mb-6 inline-flex items-center gap-2 text-base font-medium
           text-indigo-600 transition-colors hover:text-indigo-500">
    <svg class="h-4 w-4 transition-transform duration-200
                group-hover:-translate-x-1"
        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
        stroke-linejoin="round">
        <path d="M19 12H5M12 19l-7-7 7-7" />
    </svg>
    Back to board
</a>
