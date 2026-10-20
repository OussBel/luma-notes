<?php

namespace App\Livewire;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Livewire\Attributes\Url;
use Livewire\Component;

class TaskFilters extends Component
{
    #[Url]
    public string $search = '';
    public ?string $priority = null;
    public bool $hasDueDate = false;

    public function updated()
    {
        $this->dispatch(
            'task-filters-updated',
            search: $this->search,
            priority: $this->priority,
            hasDueDate: $this->hasDueDate
        );
    }

    public function resetFilters()
    {
        $this->reset(
            'search',
            'priority',
            'hasDueDate'
        );
    }

    public function render()
    {
        return view('livewire.task-filters', [
            'statuses' => TaskStatus::cases(),
            'priorities' => TaskPriority::cases()
        ]);
    }
}
