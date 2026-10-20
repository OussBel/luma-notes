<?php

namespace App\Livewire;

use App\Actions\Tasks\MoveTask;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskList extends Component
{
    public string $search = '';
    public ?string $taskPriority = null;
    public bool $hasDueDate = false;

    #[On('task-saved')]
    #[On('task-deleted')]
    public function refreshTasks()
    {
    }

    public function handleSort(MoveTask $moveTask, int $id, int $position, string $columnId): void
    {
        $moveTask->handle(taskId: $id, position: $position, status: $columnId);
    }

    #[On('task-filters-updated')]
    public function applyFilters(string $search = '', ?string $priority = null, bool $hasDueDate = false)
    {
        $this->search = $search;
        $this->taskPriority = $priority;
        $this->hasDueDate = $hasDueDate;
    }


    public function render()
    {
        $tasks = Auth::user()
            ->tasks()
            ->search($this->search)
            ->priority($this->taskPriority)
            ->hasDueDate($this->hasDueDate)
            ->orderBy('position')
            ->get()
            ->groupBy('status');

        return view('livewire.task-list', [
            'tasks' => $tasks,
            'statuses' => TaskStatus::cases(),
        ]);
    }

}

