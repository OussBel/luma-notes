<article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-xs" wire:sort:item="{{ $taskId }}">
    <div class="mb-4 min-w-0">
        <h3 class="text-base font-semibold tracking-tight text-slate-900 transition-colors group-hover:text-indigo-700">
            {{ $title }}
        </h3>

        <p class="mt-2 text-sm leading-6 text-slate-500">
            {{ \Illuminate\Support\Str::words($description, 15, ' ...') }}
        </p>
    </div>

    @if (count($tags))
        <div class="mb-5 flex flex-wrap gap-2">
            @foreach ($tags as $tag)
                <span
                    class="inline-flex items-center rounded-full px-3 py-1 text-xs font-medium ring-1 ring-inset ring-black/5 {{ $tag->bgColor }}">
                    {{ $tag->name }}
                </span>
            @endforeach
        </div>
    @endif

    <div class="flex flex-wrap items-center justify-between gap-3 border-t border-slate-100 pt-4">
        <div class="flex flex-wrap items-center gap-x-4 gap-y-2">
            <span class="inline-flex items-center gap-2 text-xs font-medium text-slate-600">
                <span @class(['size-2 rounded-full', $priority->bgColor()]) "></span>
                {{ $priority->name }}
            </span>

                                    @if ($due_date)
                    <span class="inline-flex items-center gap-1.5 text-xs font-medium text-slate-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.6"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 3v2.25M17.25 3v2.25M3.75 8.25h16.5M5.25 5.25h13.5A1.5 1.5 0 0 1 20.25 6.75v12A1.5 1.5 0 0 1 18.75 20.25H5.25a1.5 1.5 0 0 1-1.5-1.5v-12a1.5 1.5 0 0 1 1.5-1.5Z" />
                        </svg>
                        {{ $due_date->format('M d, Y') }}
                    </span>
                    @endif
        </div>

        <div class="flex shrink-0 items-center gap-2">
            <a href="{{ route('view-task', ['task' => $taskId]) }}" wire:navigate
                class="inline-flex items-center justify-center rounded-lg text-slate-400 transition
                 hover:bg-indigo-50 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/30"
                aria-label="View task">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                </svg>
            </a>
            <button type="button" wire:click="edit"
                class="inline-flex items-center justify-center rounded-lg text-slate-400 transition hover:bg-indigo-50
                 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500/30 cursor-pointer"
                aria-label="Edit task">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>

            <button type="button" wire:click="delete" wire:confirm="Are you sure you want to delete this task?"
                class="inline-flex items-center justify-center rounded-lg text-slate-400 transition cursor-pointer
                 hover:bg-red-50 hover:text-red-600 focus:outline-none focus:ring-2 focus:ring-red-500/30"
                aria-label="Delete task">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.7"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673A2.25 2.25 0 0 1 15.916 21H8.084a2.25 2.25 0 0 1-2.244-1.327L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-10.45 0a48.108 48.108 0 0 1 3.478-.397m7.65 0V4.625c0-.935-.761-1.695-1.696-1.695h-3.464c-.935 0-1.695.76-1.695 1.695V5.25m7.65 0h-7.65" />
                </svg>
            </button>
        </div>
    </div>
</article>
