<form wire:submit="logout">
    <button type="submit"
        class="group inline-flex cursor-pointer items-center gap-2 rounded-lg border border-slate-200
             bg-white px-3.5 py-2.5 text-sm font-medium text-slate-500 shadow-sm transition-all
              duration-200 hover:border-slate-300 hover:bg-slate-50 hover:text-indigo-700
               focus:outline-none focus:bg-blue-indigo-700">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor"
            class="size-4 transition-transform duration-200 group-hover:translate-x-0.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5
                 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25
                     2.25 0 0 0 2.25-2.25V15" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M18 15l3-3m0 0l-3-3m3 3H9" />
        </svg>

        <span>Logout</span>
    </button>
</form>
