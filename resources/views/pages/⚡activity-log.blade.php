<?php

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

new class extends Component {
    use WithPagination;

    public function refreshActivities(): void
    {
        unset($this->activities);
        $this->resetPage();
    }

    #[Computed]
    public function activities()
    {
        $userId = auth()->id();

        return DB::table('activities')
            ->where('user_id', $userId ?? 0)
            ->orderByDesc('created_at')
            ->simplePaginate(3)
            ->through(function ($activity) {
                $action = strtolower($activity->action);

                [$color, $icon] = match ($action) {
                    'created' => ['emerald', '+'],
                    'updated' => ['blue', '↻'],
                    'deleted' => ['rose', '×'],
                    default => ['slate', '•'],
                };

                $date = Carbon::parse($activity->created_at);

                $activity->title = $activity->task_title;
                $activity->time = $date->format('h:i A');

                $activity->date = match (true) {
                    $date->isToday() => 'Today',
                    $date->isYesterday() => 'Yesterday',
                    default => $date->format('F j, Y'),
                };

                $activity->color = $color;
                $activity->icon = $icon;

                return $activity;
            });
    }
};
?>


<div class="min-h-screen bg-slate-50 px-4 py-8 sm:px-8">
    <div class="mx-auto max-w-5xl">
        <div class="mb-8 flex flex-col gap-4 sm:flex-row items-start justify-between">
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

            <button type="button" wire:click="refreshActivities" wire:loading.attr="disabled"
                wire:target="refreshActivities" aria-label="Refresh activities" title="Refresh activities"
                class="flex h-12 w-12 items-center justify-center rounded-2xl
           bg-indigo-100 text-2xl text-indigo-700 cursor-pointer
           transition hover:bg-indigo-200
           focus:outline-none focus:ring-2 focus:ring-indigo-500
           focus:ring-offset-2 disabled:cursor-wait disabled:opacity-60">
                <span wire:loading.remove wire:target="refreshActivities">↻</span>
                <svg wire:loading wire:target="refreshActivities" class="hidden h-6 w-6 animate-spin"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                        stroke-width="4" />
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z" />
                </svg>
            </button>
        </div>

        <a href="{{ route('board') }}" wire:navigate
            class="group mb-6 inline-flex items-center gap-2 text-base font-medium text-indigo-600 transition-colors
             hover:text-indigo-500">
            <svg class="h-4 w-4 transition-transform duration-200 group-hover:-translate-x-1" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7" />
            </svg>
            Back to board
        </a>

        {{-- Activity summary --}}
        <div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600">
                        Recorded activities
                    </p>

                    <p class="mt-1 text-3xl font-bold text-slate-900">
                        {{ count($this->activities) }}
                    </p>

                    <p class="mt-1 text-sm text-slate-500">
                        Your recent actions in one place.
                    </p>
                </div>

                <div class="rounded-xl bg-indigo-100 p-3 text-indigo-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Activity timeline --}}
        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:p-8">

            <div class="mb-8">
                <p class="text-sm font-bold uppercase tracking-widest text-indigo-600">
                    Your history
                </p>

                <h2 class="mt-2 text-xl font-bold text-slate-900">
                    Recent activity
                </h2>

                <p class="mt-2 text-sm text-slate-600">
                    A timeline of your recent actions.
                </p>
            </div>

            @forelse ($this->activities as $index => $activity)
                {{-- Date heading --}}
                @if ($index === 0 || $activity->date !== $this->activities[$index - 1]->date)
                    <div class="{{ $index === 0 ? '' : 'mt-8' }} mb-5">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">
                            {{ $activity->date }}
                        </h3>
                    </div>
                @endif

                <div class="relative flex gap-4 pb-7 last:pb-0">
                    {{-- Timeline line --}}
                    @if (!$loop->last)
                        <div class="absolute bottom-0 left-5 top-11 w-px bg-slate-200"></div>
                    @endif

                    {{-- Action icon --}}
                    <div
                        class="relative z-10 flex h-10 w-10 shrink-0 items-center justify-center rounded-xl
                        {{ $activity->color === 'emerald' ? 'bg-emerald-100 text-emerald-700' : '' }}
                        {{ $activity->color === 'blue' ? 'bg-indigo-100 text-indigo-700' : '' }}
                        {{ $activity->color === 'rose' ? 'bg-amber-100 text-amber-700' : '' }}
                        {{ $activity->color === 'slate' ? 'bg-slate-100 text-slate-700' : '' }}
                        text-xl font-medium">
                        {{ $activity->icon }}
                    </div>

                    {{-- Activity details --}}
                    <div class="min-w-0 flex-1 pt-1">
                        <div class="flex flex-col gap-1 sm:flex-row sm:items-start sm:justify-between sm:gap-4">
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

            @empty
                <div class="py-12 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-100 
                        text-2xl text-indigo-600">
                        ↻
                    </div>

                    <h3 class="font-bold text-slate-900">
                        No activity yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-600">
                        Your note activities will appear here as you create, update, and manage your notes.
                    </p>

                    <a href="{{ route('home') }}" wire:navigate
                        class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-3 font-semibold
                         text-white transition hover:bg-indigo-700">
                        Back to your notes
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            @endforelse
        </div>
        {{ $this->activities->links() }}
        {{-- Footer --}}
        <p class="mt-6 text-center text-xs text-slate-500">
            Your notes, your history, all in one place.
        </p>
    </div>
</div>
