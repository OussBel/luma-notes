<?php

namespace Database\Seeders;
use App\Models\Task;
use App\Enums\TaskStatus;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        foreach (TaskStatus::cases() as $status) {
            Task::factory(5)->create([
                'status' => $status,
            ])->each(function (Task $task, int $index) {
                $task->update([
                    'position' => $index + 1,
                ]);
            });
        }
    }
}
