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

    public function color(): string
    {
        return match ($this) {
            self::Todo => 'bg-slate-50 text-slate-700 ring-1 ring-inset ring-slate-200',
            self::InProgress => 'bg-blue-50 text-blue-700 ring-1 ring-inset ring-blue-200',
            self::Done => 'bg-emerald-50 text-emerald-700 ring-1 ring-inset ring-emerald-200',
            self::Archived => 'bg-violet-50 text-violet-700 ring-1 ring-inset ring-violet-200',
        };
    }

    public function bgColor(): string
    {
        return match ($this) {
            self::Todo => 'bg-slate-400',
            self::InProgress => 'bg-blue-500',
            self::Done => 'bg-emerald-500',
            self::Archived => 'bg-violet-500',
        };
    }
}
