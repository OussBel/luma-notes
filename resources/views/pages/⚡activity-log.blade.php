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
            ->simplePaginate(10)
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

        <x-activity.header />

        <x-activity.summary :count="count($this->activities)" />

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
                {{-- Show a heading when the date changes --}}
                @if ($index === 0 || $activity->date !== $this->activities[$index - 1]->date)
                    <div class="{{ $index === 0 ? '' : 'mt-8' }} mb-5">
                        <h3 class="text-xs font-bold uppercase tracking-widest text-slate-500">
                            {{ $activity->date }}
                        </h3>
                    </div>
                @endif

                <x-activity.item :activity="$activity" :is-last="$loop->last" />

            @empty

                {{-- Empty state --}}
                <div class="py-12 text-center">
                    <div
                        class="mx-auto mb-4 flex h-14 w-14 items-center
                                justify-center rounded-2xl bg-indigo-100
                                text-2xl text-indigo-600">
                        ↻
                    </div>

                    <h3 class="font-bold text-slate-900">
                        No activity yet
                    </h3>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-600">
                        Your note activities will appear here as you create,
                        update, and manage your notes.
                    </p>

                    <a href="{{ route('home') }}" wire:navigate
                        class="mt-6 inline-flex items-center gap-2 rounded-xl
                               bg-indigo-600 px-5 py-3 font-semibold text-white
                               transition hover:bg-indigo-700">
                        Back to your notes
                        <span aria-hidden="true">&rarr;</span>
                    </a>
                </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        {{ $this->activities->links(data: ['scrollTo' => false]) }}

        {{-- Footer --}}
        <p class="mt-6 text-center text-xs text-slate-500">
            Your notes, your history, all in one place.
        </p>

    </div>
</div>
