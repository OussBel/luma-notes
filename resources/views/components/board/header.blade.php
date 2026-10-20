<header class="mb-6 flex items-start justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Board
        </h1>
        <p class="text-slate-500">
            Let's add some tasks.
        </p>
    </div>

    <livewire:task-filters />

    <div class="flex items-center gap-2.5">
        <button type="button" @click="openTag = true"
            class="inline-flex cursor-pointer items-center gap-2 rounded-lg border border-slate-200 bg-white px-4 py-2.5 text-sm font-medium text-slate-600 shadow-sm transition-all duration-200 hover:border-indigo-200 hover:bg-indigo-50 hover:text-indigo-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8"
                stroke="currentColor" class="size-4.5">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M9.568 3.625H5.25A2.25 2.25 0 0 0 3 5.875v4.318c0 .597.237 1.17.659 1.591l8.557 8.557a2.25 2.25 0 0 0 3.182 0l4.943-4.943a2.25 2.25 0 0 0 0-3.182L11.159 4.284a2.25 2.25 0 0 0-1.591-.659Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 7.875h.008v.008H6.75v-.008Z" />
            </svg>

            <span>Create tags</span>
        </button>

        <button type="button" @click="open = true"
            class="inline-flex cursor-pointer items-center gap-2 rounded-lg bg-indigo-700 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition-all duration-200 hover:bg-indigo-600 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" class="size-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>

            <span>New Task</span>
        </button>

        <div class="mx-1 h-8 w-px bg-slate-200"></div>
        <livewire:auth.logout />
    </div>
</header>
