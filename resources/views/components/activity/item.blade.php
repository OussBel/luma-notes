@props(['activity', 'isLast' => false])

<div class="relative flex gap-4 pb-7 last:pb-0">
    @unless ($isLast)
        <div class="absolute bottom-0 left-5 top-11 w-px bg-slate-200"></div>
    @endunless

    <div
        class="relative z-10 flex h-10 w-10 shrink-0 items-center
                justify-center rounded-xl text-xl font-medium
        {{ $activity->color === 'emerald' ? 'bg-emerald-100 text-emerald-700' : '' }}
        {{ $activity->color === 'blue' ? 'bg-indigo-100 text-indigo-700' : '' }}
        {{ $activity->color === 'rose' ? 'bg-amber-100 text-amber-700' : '' }}
        {{ $activity->color === 'slate' ? 'bg-slate-100 text-slate-700' : '' }}">
        {{ $activity->icon }}
    </div>

    <div class="min-w-0 flex-1 pt-1">
        <div class="flex flex-col gap-1 sm:flex-row sm:items-start
                    sm:justify-between sm:gap-4">
            <div>
                <p class="font-semibold text-slate-900">
                    {{ $activity->title }}
                </p>

                <p class="mt-1 text-sm leading-6 text-slate-600">
                    {{ $activity->description }}
                </p>
            </div>

            <span class="shrink-0 text-xs font-medium text-slate-500">
                {{ $activity->time }}
            </span>
        </div>
    </div>
</div>
