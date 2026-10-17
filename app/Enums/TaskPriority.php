<?php

namespace App\Enums;

enum TaskPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';

    public function color(): string
    {
        return match ($this) {
            self::Low => 'text-emerald-500',
            self::Medium => 'text-amber-400',
            self::High => 'text-rose-500',
        };
    }

    public function bgColor(): string
    {
        return match ($this) {
            self::Low => 'bg-emerald-500',
            self::Medium => 'bg-amber-400',
            self::High => 'bg-rose-500',
        };
    }
}
