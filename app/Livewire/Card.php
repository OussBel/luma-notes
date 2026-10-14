<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use Illuminate\Support\Facades\Gate;
use Carbon\Carbon;

use App\Enums\TaskPriority;
use App\Models\Task;

class Card extends Component
{
    #[Reactive]
    public int $taskId;

    #[Reactive]
    public string $title;

    #[Reactive]
    public string $description;

    #[Reactive]
    public TaskPriority $priority;

    #[Reactive]
    public ?Carbon $due_date;

    #[Reactive]
    public $tags = [];

    public function edit()
    {
        $this->dispatch('edit-task', id: $this->taskId);
    }

    public function delete()
    {
        $task = Task::findOrFail($this->taskId);

        Gate::authorize('delete', $task);

        $task->delete();
        $this->dispatch('task-deleted');
    }


    public function render()
    {
        return view('livewire.card');
    }
}
