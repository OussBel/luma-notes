<?php

namespace App\Observers;

use App\Models\Activity;
use App\Models\Task;

class TaskObserver
{
    /**
     * Handle the Task "created" event.
     */
    public function created(Task $task): void
    {
        Activity::create([
            'user_id' => auth()->id(),
            'task_id' => $task->id,
            'action' => 'created',
            'task_title' => $task->title,
            'description' => "Created task: {$task->title}",
        ]);
    }

    /**
     * Handle the Task "updated" event.
     */
    public function updated(Task $task): void
    {
        Activity::create([
            'user_id' => auth()->id(),
            'task_id' => $task->id,
            'action' => 'updated',
            'task_title' => $task->title,
            'description' => "Updated task: {$task->title}",
        ]);
    }

    /**
     * Handle the Task "deleted" event.
     */
    public function deleted(Task $task): void
    {
        Activity::create([
            'user_id' => auth()->id(),
            'task_id' => null,
            'action' => 'deleted',
            'task_title' => $task->title,
            'description' => "Deleted task: {$task->title}",
        ]);
    }
}
