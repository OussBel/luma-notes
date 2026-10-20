<div x-cloak x-show="open" x-transition @task-saved.window="open = false"
    @open-task-modal.window="
    console.log('open-task-modal received');
    open = true;
    console.log('open:', open);
"
    class="fixed inset-0 z-50 flex items-center justify-center bg-white/30 p-4 backdrop-blur-sm">
    <form wire:submit="save" @click.outside="open = false; $wire.clearForm()"
        class="w-full max-w-xl max-h-[90vh] overflow-y-auto rounded-2xl border border-slate-200 bg-white p-6 shadow-xl">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-800">
                {{ $task ? 'Edit Task' : 'New Task' }}
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                {{ $task ? 'Update your task details.' : 'Add a new task to your board.' }}
            </p>
        </div>

        <div class="grid gap-5 md:grid-cols-2">
            <div class="md:col-span-2">
                <label for="title" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Title
                </label>
                <input type="text" id="title" wire:model="title" placeholder="Enter task title"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 
                    bg-indigo-50 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                @error('title')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="md:col-span-2">
                <label for="description" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Description
                </label>

                <textarea id="description" wire:model="description" rows="4" placeholder="Describe the task..."
                    class="w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-sm text-slate-800 
                  bg-indigo-50 outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100"></textarea>

                @error('description')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Tags --}}
            @if ($tags->isNotEmpty())
                <fieldset class="md:col-span-2">
                    <legend class="mb-1.5 block text-sm font-medium text-slate-700">
                        Tags
                    </legend>
                    <div id="tags"
                        class="w-full resize-none rounded-lg border border-slate-300 px-3 py-2 text-sm bg-indigo-50
                     flex flex-wrap gap-3">
                        @foreach ($tags as $tag)
                            <button type="button" wire:click="selectTags({{ $tag->id }})"
                                @class([
                                    'inline-flex items-center gap-2 px-3 py-2 rounded-lg cursor-pointer text-white',
                                    $tag->bgColor,
                                ])>
                                @if (in_array($tag->id, $selectedTags))
                                    <span class="font-bold text-white">✓</span>
                                @endif
                                {{ $tag->name }}
                                <span
                                    class="cursor-pointer flex items-center justify-center w-5 h-5 rounded-full
                                     hover:bg-red-700"
                                    wire:click.stop="deleteTag({{ $tag->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="size-3.5">
                                        <path fill-rule="evenodd"
                                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </button>
                        @endforeach
                    </div>
                </fieldset>
            @endif

            {{-- Status --}}
            <div>
                <label for="status" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Status
                </label>
                <select id="status" wire:model="status"
                    class="w-full rounded-lg border border-slate-300 bg-indigo-50 px-3 py-2 text-sm text-slate-800
                    outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @foreach ($statuses as $statusOption)
                        <option value="{{ $statusOption->value }}">
                            {{ $statusOption->label() }}
                        </option>
                    @endforeach
                </select>

                @error('status')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Priority --}}
            <div>
                <label for="priority" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Priority
                </label>

                <select id="priority" wire:model="priority"
                    class="w-full rounded-lg border border-slate-300 bg-indigo-50 px-3 py-2 text-sm text-slate-800
                    outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">
                    @foreach ($priorities as $priorityOption)
                        <option value="{{ $priorityOption->value }}">
                            {{ $priorityOption->name }}
                        </option>
                    @endforeach
                </select>

                @error('priority')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Due date --}}
            <div>
                <label for="due_date" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Due date
                </label>

                <input type="date" id="due_date" wire:model="due_date"
                    class="w-full rounded-lg border border-slate-300 bg-indigo-50 px-3 py-2 text-sm text-slate-800
                    outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100">

                @error('due_date')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

        </div>

        <div class="mt-6 flex justify-end gap-3">

            <button type="button" wire:click="clearForm" @click="open = false"
                class="cursor-pointer rounded-lg px-4 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100">
                Cancel
            </button>

            <button type="submit"
                class="cursor-pointer rounded-lg bg-indigo-700 px-5 py-2 text-sm font-medium text-white hover:bg-indigo-600">
                {{ $task ? 'Update task' : 'Save task' }}
            </button>
        </div>

    </form>
</div>
