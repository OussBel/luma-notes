<?php

namespace App\Livewire;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\Component;

class TaskForm extends Component
{
    public $tags = [];
    public $selectedTags = [];
    public string $title = '';
    public string $description = '';
    public TaskStatus $status = TaskStatus::Todo;
    public TaskPriority $priority = TaskPriority::Medium;
    public ?string $due_date = null;
    public ?Task $task = null;


    public function mount()
    {
        $this->refreshTags();
    }

    #[On('tags-saved')]
    public function refreshTags()
    {
        $this->tags = Tag::where('user_id', Auth::user()->id)->orderBy('name')->get();
    }

    protected function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'description' => [
                'nullable',
                'string',
            ],
            'status' => [
                'required',
                Rule::enum(TaskStatus::class),
            ],
            'priority' => [
                'required',
                Rule::enum(TaskPriority::class),
            ],
            'due_date' => [
                'nullable',
                'date',
            ],
            'selectedTags' => ['array'],
            'selectedTags.*' => [
                'integer',
                Rule::exists('tags', 'id')
                    ->where('user_id', Auth::id())
            ]
        ];
    }

    public function clearForm(): void
    {
        $this->reset([
            'title',
            'description',
            'due_date',
            'task',
            'selectedTags'
        ]);

        $this->status = TaskStatus::Todo;
        $this->priority = TaskPriority::Medium;

        $this->resetValidation();
    }

    #[On('edit-task')]
    public function edit(int $id): void
    {
        $this->task = Auth::user()->tasks()->with('tags')->findOrFail($id);

        $this->title = $this->task->title;
        $this->description = $this->task->description ?? '';
        $this->status = $this->task->status;
        $this->priority = $this->task->priority;
        $this->due_date = $this->task->due_date?->format('Y-m-d');

        $this->selectedTags = $this->task->tags->modelKeys();
    }

    public function save(): void
    {
        $this->due_date = $this->due_date ?: null;

        $validated = $this->validate();

        unset($validated['selectedTags']);

        DB::transaction(function () use ($validated) {
            if ($this->task) {
                Gate::authorize('update', $this->task);
                $this->task->update($validated);
            } else {
                $this->task = Auth::user()->tasks()->create($validated);
            }

            $this->task->tags()->sync($this->selectedTags);
        });

        $this->clearForm();
        $this->dispatch('task-saved');
    }

    public function deleteTag(int $tagId)
    {
        $tag = Tag::findOrFail($tagId);

        $tag->delete();

        $this->selectedTags = array_values(
            array_diff($this->selectedTags, [$tagId])
        );
    }

    public function selectTags(int $id)
    {
        if (in_array($id, $this->selectedTags)) {
            $this->selectedTags = array_values(array_diff($this->selectedTags, [$id]));
        } else {
            $this->selectedTags[] = $id;
        }
    }

    public function render()
    {
        return view('livewire.task-form', [
            'statuses' => TaskStatus::cases(),
            'priorities' => TaskPriority::cases(),
        ]);
    }
}