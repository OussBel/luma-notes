<?php

use Livewire\Component;
use App\Models\Task;

new class extends Component {
    public Task $task;

    public function mount(Task $task): void
    {
        $this->task = $task;
    }
};
?>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 py-12 px-4 sm:px-6">
    <div class="mx-auto max-w-3xl">

        <a href="{{ route('board') }}" wire:navigate
            class="group mb-6 inline-flex items-center gap-2 text-sm font-medium text-slate-500 transition-colors hover:text-indigo-600">
            <svg class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-1" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Back to board
        </a>

        <div
            class="overflow-hidden rounded-2xl border border-slate-200/80 bg-white/80 backdrop-blur-xl p-8 shadow-xl shadow-slate-200/50 sm:p-10">

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <h1 class="text-3xl font-bold tracking-tight text-slate-900">
                    {{ $task->title }}
                </h1>
            </div>

            <div class="mt-6 text-base leading-relaxed text-slate-600">
                <p>{{ $task->description }}</p>
            </div>

            <div class="mt-10 flex flex-wrap items-center gap-6 border-t border-slate-100 pt-6">

                @if ($task->due_date)
                    <div
                        class="flex items-center gap-2.5 rounded-lg bg-slate-50 px-3 py-2 border border-slate-100 text-sm">
                        <svg class="h-4 w-4 text-slate-400" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="5" width="18" height="16" rx="2" />
                            <path d="M16 3v4M8 3v4M3 10h18" />
                        </svg>
                        <span class="text-slate-700 text-xs font-medium uppercase tracking-wider">Due</span>
                        <span class="font-semibold text-slate-700">{{ $task->due_date->format('M d, Y') }}</span>
                    </div>
                @endif

                <div class="flex items-center gap-2.5 rounded-lg bg-slate-50 px-3 py-2 border border-slate-100 text-sm">
                    <span class="text-slate-700 text-xs font-medium uppercase tracking-wider">Status</span>
                    <span @class([
                        'rounded-md bg-indigo-50 px-2 py-0.5 text-xs font-semibold',
                        $task->status->color(),
                    ])>
                        {{ $task->status->label() }}
                    </span>
                </div>

                <div class="flex items-center gap-2.5 rounded-lg border border-slate-100 bg-slate-50 px-3 py-2 text-sm">
                    <svg @class(['h-4 w-4', $task->priority->color()]) viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 21V5m0 0h11l-2 4 2 4H5" />
                    </svg>

                    <span class="text-xs font-medium uppercase tracking-wider text-slate-700">
                        Priority
                    </span>

                    <span @class(['font-semibold', $task->priority->color()])>
                        {{ $task->priority->name }}
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
