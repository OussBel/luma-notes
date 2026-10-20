<div class="space-y-5">
    <div class="relative">
        <svg class="absolute left-4 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400" xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                d="m21 21-4.5-4.5m2-5.5a7.5 7.5 0 1 1-15 0 7.5 7.5 0 0 1 15 0Z" />
        </svg>

        <input type="search" wire:model.live.debounce.300ms="search" placeholder="Search your tasks..."
            class="w-full rounded-2xl border border-slate-200/80 bg-white py-3.5 pl-12 pr-4 text-sm
             text-slate-800 shadow-sm transition placeholder:text-slate-400 hover:border-slate-300
              focus:border-blue-400 focus:outline-none focus:ring-4 focus:ring-blue-500/10" />
    </div>

    <div class="flex flex-wrap items-center gap-2.5">
        <span class="mr-1 flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-slate-400">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16M7 12h10m-7 6h4" />
            </svg>
            Filter
        </span>

        <div class="relative">
            <select wire:model.live="priority"
                class="appearance-none rounded-xl border border-slate-200 bg-white py-2.5 pl-3.5
                 pr-9 text-sm font-medium text-slate-400 shadow-sm outline-none transition
                  hover:border-slate-300 focus:border-blue-400 focus:ring-4 focus:ring-blue-500/10">
                <option value="">All priorities</option>
                @foreach ($priorities as $priority)
                    <option value="{{ $priority->value }}">{{ $priority->name }}</option>
                @endforeach
            </select>

            <svg class="pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 10 5 5 5-5" />
            </svg>
        </div>

        <label for="due_date" @class([
            'inline-flex cursor-pointer items-center rounded-xl border px-3.5 py-2.5 text-sm',
            'font-medium shadow-sm transition-all duration-100',
            'border-blue-300 bg-blue-50 text-blue-700' => $hasDueDate,
            'border-slate-200 bg-white text-slate-400 hover:border-slate-300' => !$hasDueDate,
        ])>
            <input type="checkbox" class="sr-only" name="due_date" id="due_date" wire:model.live="hasDueDate">
            <span>Due date</span>
        </label>

        <div class="mx-1 hidden h-6 w-px bg-slate-200 sm:block"></div>

        <button type="button" wire:click="resetFilters"
            class="rounded-xl px-3 py-2.5 text-sm font-medium text-slate-400 transition cursor-pointer
             hover:bg-slate-100 hover:text-slate-700">
            Clear all
        </button>
    </div>
</div>
