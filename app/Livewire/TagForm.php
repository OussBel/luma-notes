<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;

class TagForm extends Component
{
    public array $colors = [
        [
            'color' => 'indigo-500',
            'bg' => 'bg-indigo-500',
            'outline' => 'outline-indigo-500',
        ],
        [
            'color' => 'blue-500',
            'bg' => 'bg-blue-500',
            'outline' => 'outline-blue-500',
        ],
        [
            'color' => 'sky-500',
            'bg' => 'bg-sky-500',
            'outline' => 'outline-sky-500',
        ],
        [
            'color' => 'emerald-500',
            'bg' => 'bg-emerald-500',
            'outline' => 'outline-emerald-500',
        ],
        [
            'color' => 'green-500',
            'bg' => 'bg-green-500',
            'outline' => 'outline-green-500',
        ],
        [
            'color' => 'amber-500',
            'bg' => 'bg-amber-500',
            'outline' => 'outline-amber-500',
        ],
        [
            'color' => 'orange-500',
            'bg' => 'bg-orange-500',
            'outline' => 'outline-orange-500',
        ],
        [
            'color' => 'rose-500',
            'bg' => 'bg-rose-500',
            'outline' => 'outline-rose-500',
        ],
        [
            'color' => 'purple-500',
            'bg' => 'bg-purple-500',
            'outline' => 'outline-purple-500',
        ],
    ];

    #[Validate('required|string|min:1|max:30')]
    public string $tag = '';

    #[Validate('required|integer|between:0,8')]
    public ?int $selectedColor = 0;

    public array $tags = [];

    public function addTag(): void
    {
        $this->tag = trim($this->tag);

        $this->validate();

        // Prevent duplicate tags
        if (collect($this->tags)->contains(fn($tag) => strtolower($tag['name']) === strtolower($this->tag))) {
            $this->addError('tag', 'This tag already exists.');
            return;
        }

        $this->tags[] = [
            'name' => $this->tag,
            'color' => $this->colors[$this->selectedColor]['color'],
            'colorIndex' => $this->selectedColor,
        ];

        $this->reset('tag', 'selectedColor');
    }

    public function removeTag(int $index): void
    {
        if (!isset($this->tags[$index])) {
            return;
        }

        unset($this->tags[$index]);

        $this->tags = array_values($this->tags);
    }

    public function clearForm(): void
    {
        $this->reset('tag', 'tags', 'selectedColor');
        $this->resetValidation();
    }

    public function save(): void
    {
        foreach ($this->tags as $tag) {
            Tag::create([
                'name' => $tag['name'],
                'color' => $tag['color'],
                'user_id' => Auth::user()->id
            ]);
        }

        $this->reset('tag', 'tags');
        $this->resetValidation();

        $this->dispatch('tags-saved');
    }

    public function render()
    {
        return view('livewire.tag-form');
    }
}
