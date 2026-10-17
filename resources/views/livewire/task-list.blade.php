<div x-data="{ open: false, openTag: false }" class="min-h-screen bg-slate-50 p-8">
    <x-board.header />
    <livewire:tag-form />
    <livewire:task-form />

    <div class="grid grid-cols-1 items-start gap-6 text-slate-800 md:grid-cols-3 lg:grid-cols-4">
        @foreach ($statuses as $status)
            <x-board.column :status="$status" :tasks="$tasks->get($status->value, collect())" />
        @endforeach
    </div>
</div>
