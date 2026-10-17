@props(['tasks', 'status'])

<section wire:key="column-{{ $status->value }}" wire:sort="handleSort" wire:sort:group="tasks"
    wire:sort:group-id="{{ $status->value }}" class="space-y-4 rounded-2xl border border-slate-200 bg-slate-100 p-6">
    <h2 class="font-semibold">
        <span @class(['w-3 h-3 inline-block rounded-full mr-1', $status->bgColor()])></span> {{ $status->label() }}
    </h2>

    @foreach ($tasks as $task)
        <livewire:card :task-id="$task->id" :title="$task->title" :description="$task->description" :priority="$task->priority" :due_date="$task->due_date"
            :tags="$task->tags" :wire:key="'task-' . $task->id . '-' . $task->status->value" />
    @endforeach
</section>
