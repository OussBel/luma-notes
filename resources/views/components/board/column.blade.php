@props(['tasks', 'status'])
<section wire:key="column-{{ $status->value }}" wire:sort="handleSort" wire:sort:group="tasks"
    wire:sort:group-id="{{ $status->value }}" class="space-y-4 rounded-2xl border border-slate-200 bg-slate-100 p-6">
    <h2 class="font-semibold">
        {{ $status->label() }}
    </h2>

    @foreach ($tasks as $task)
        <livewire:card :task-id="$task->id" :title="$task->title" :description="$task->description" :priority="$task->priority" :due_date="$task->due_date"
            :tags="$task->tags
                ->map(
                    fn($tag) => [
                        'id' => $tag->id,
                        'name' => $tag->name,
                        'bgColor' => $tag->bgColor,
                    ],
                )
                ->all()" :wire:key="'task-' . $task->id . '-' . $task->status->value" />
    @endforeach
</section>
