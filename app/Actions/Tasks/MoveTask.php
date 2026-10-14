<?php

namespace App\Actions\Tasks;

use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\DB;

final class MoveTask
{
    public function handle(
        int $taskId,
        int $position,
        string $status,
    ): void {
        DB::transaction(function () use ($taskId, $position, $status) {
            $task = Task::findOrFail($taskId);
            $newStatus = TaskStatus::from($status);

            $tasks = Task::query()
                ->where('status', $newStatus)
                ->whereKeyNot($task->id)
                ->orderBy('position')
                ->get();

            $tasks->splice($position, 0, [$task]);

            foreach ($tasks as $index => $task) {
                $task->update([
                    'status' => $newStatus,
                    'position' => $index + 1,
                ]);
            }
        });
    }
}