<?php

namespace App\Livewire;

use App\Actions\Tasks\MoveTask;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskList extends Component
{
    #[On('task-saved')]
    #[On('task-deleted')]
    #[On('edit-task')]
    public function refreshTasks()
    {
    }

    public function handleSort(MoveTask $moveTask, int $id, int $position, string $columnId): void
    {
        $moveTask->handle(taskId: $id, position: $position, status: $columnId);
    }

    public function render()
    {
        return view('livewire.task-list', [
            'tasks' => Auth::user()->tasks()->orderBy('position')->get()->groupBy('status'),
            'statuses' => TaskStatus::cases()
        ]);
    }
}

