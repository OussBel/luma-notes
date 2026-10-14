<?php

namespace App\Enums;

enum TaskStatus: string
{
    case Todo = 'todo';
    case InProgress = 'in_progress';
    case Done = 'done';
    case Archived = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::Todo => "To do",
            self::InProgress => "In progress",
            self::Done => "Done",
            self::Archived => "Archived",
        };
    }
}
