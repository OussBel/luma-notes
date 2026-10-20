<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Attributes\Scope;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Builder;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date', 'position', 'user_id'];

    protected function casts(): array
    {
        return
            [
                'status' => TaskStatus::class,
                'priority' => TaskPriority::class,
                'due_date' => 'date',
                'completed_at' => 'datetime'
            ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    #[Scope]
    protected function search(Builder $query, ?string $search): void
    {
        $query->when($search, function ($query, $term) {
            $searchKeyword = '%' . $term . '%';
            $query->where(function ($q) use ($searchKeyword) {
                $q->where('title', 'like', $searchKeyword)
                    ->orWhere('description', 'like', $searchKeyword);
            });
        });
    }

    #[Scope]
    protected function priority(Builder $query, ?string $priority): void
    {
        $query->when($priority, function ($q, $priorityValue) {
            $q->where('priority', $priorityValue);
        });
    }

    #[Scope]
    protected function hasDueDate(Builder $query, bool $hasDueDate): void
    {
        $query->when($hasDueDate, function ($q) {
            $q->whereNotNull('due_date');
        });
    }

}
