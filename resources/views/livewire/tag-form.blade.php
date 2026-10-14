<div x-cloak x-show="openTag" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-slate-950/40 p-4 backdrop-blur-sm"
    @tags-saved.window="openTag = false">
    <div class="w-full max-w-lg overflow-hidden rounded-2xl bg-white shadow-2xl ring-1 ring-black/5"
        @click.outside="openTag = false; $wire.clearForm()">
        {{-- Header --}}
        <div class="border-b border-slate-100 px-6 py-5">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-slate-900">
                        Manage tags
                    </h3>

                    <p class="mt-1 text-sm text-slate-500">
                        Create colored tags to organize your tasks.
                    </p>
                </div>

                <button type="button" @click="openTag = false; $wire.clearForm()"
                    class="flex size-8 shrink-0 items-center justify-center rounded-lg
                           text-slate-400 transition hover:bg-slate-100
                           hover:text-slate-700 cursor-pointer"
                    aria-label="Close">
                    <svg class="size-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Content --}}
        <form wire:submit="save">
            <div class="space-y-6 p-6">
                {{-- Tag name --}}
                <div>
                    <label for="tag" class="mb-2 block text-sm font-medium text-slate-700">
                        Tag name
                    </label>

                    <div class="flex gap-2">
                        <input id="tag" type="text" wire:model.live="tag" wire:keydown.enter.prevent="addTag"
                            maxlength="30" autocomplete="off" aria-required="true" aria-describedby="tag-help tag-error"
                            class="h-11 min-w-0 flex-1 rounded-lg border
                               bg-white px-3.5 text-sm text-slate-900
                               outline-none transition
                               placeholder:text-slate-400
                               hover:border-slate-300
                               focus:border-indigo-500
                               focus:ring-4 focus:ring-indigo-500/10
                               @error('tag')
                                   border-red-500 focus:border-red-500
                                   focus:ring-red-500/10
                               @else
                                   border-slate-200
                               @enderror"
                            placeholder="e.g. Programming">

                        <button type="button" wire:click="addTag"
                            class="h-11 rounded-lg bg-indigo-600 px-4 text-sm
                               font-medium text-white cursor-pointer
                               shadow-sm transition
                               hover:bg-indigo-700
                               active:bg-indigo-800
                               disabled:cursor-not-allowed
                               disabled:opacity-40">
                            Add
                        </button>
                    </div>

                    <div id="tag-help" class="mt-1.5 flex justify-between text-xs text-slate-400">
                        <span>Press Enter to add</span>
                        <span>{{ strlen($tag) }}/30</span>
                    </div>

                    @error('tag')
                        <p id="tag-error" class="mt-1.5 text-xs text-red-600" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Color picker --}}
                <div>
                    <div class="mb-3 flex items-center justify-between">
                        <label class="text-sm font-medium text-slate-700">
                            Tag color
                        </label>

                        <span class="text-xs text-slate-400">
                            Choose a color
                        </span>
                    </div>

                    <div class="flex flex-wrap gap-3" role="radiogroup" aria-label="Tag color">
                        @foreach ($colors as $index => $color)
                            <button type="button" wire:key="color-{{ $index }}"
                                wire:click="$set('selectedColor', {{ $index }})"
                                aria-label="Select {{ $color['color'] }}"
                                aria-pressed="{{ (int) $selectedColor === (int) $index ? 'true' : 'false' }}"
                                class="{{ $color['bg'] }}
                                   size-8 rounded-full cursor-pointer
                                   transition hover:scale-110
                                   {{ (int) $selectedColor === (int) $index ? $color['outline'] . ' outline-2 outline-offset-2' : '' }}"></button>
                        @endforeach
                    </div>

                    @error('selectedColor')
                        <p class="mt-2 text-xs text-red-600" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Preview --}}
                @if (trim($tag) !== '')
                    <div>
                        <p class="mb-2 text-sm font-medium text-slate-700">
                            Preview
                        </p>

                        <div class="rounded-xl border border-dashed border-slate-200 bg-slate-50 p-4">
                            <span
                                class="{{ $colors[$selectedColor]['bg'] }}
                                   inline-flex items-center rounded-md
                                   px-2.5 py-1 text-xs font-medium text-white">
                                {{ trim($tag) }}
                            </span>
                        </div>
                    </div>
                @endif

                {{-- Existing tags --}}
                <div>
                    <div class="mb-3 flex items-center justify-between">
                        <p class="text-sm font-medium text-slate-700">
                            Your tags
                        </p>

                        @if (count($tags) > 0)
                            <span class="text-xs text-slate-400">
                                {{ count($tags) }}
                                {{ count($tags) === 1 ? 'tag' : 'tags' }}
                            </span>
                        @endif
                    </div>

                    <div class="min-h-20 rounded-xl border border-slate-200 bg-slate-50 p-3">
                        @if (count($tags) > 0)
                            <div class="flex flex-wrap gap-2">
                                @foreach ($tags as $index => $tag)
                                    <span wire:key="tag-{{ $index }}"
                                        class="{{ $colors[$tag['colorIndex']]['bg'] }}
                                           inline-flex items-center gap-1
                                           rounded-md px-2.5 py-1
                                           text-xs font-medium text-white">
                                        {{ $tag['name'] }}

                                        <button type="button" wire:click="removeTag({{ $index }})"
                                            class="ml-0.5 rounded-full p-0.5
                                               text-white/70 transition
                                               hover:bg-white/20
                                               hover:text-white"
                                            aria-label="Remove {{ $tag['name'] }}">
                                            <svg class="size-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18 18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </span>
                                @endforeach
                            </div>
                        @else
                            <div class="flex min-h-14 items-center justify-center">
                                <p class="text-sm text-slate-400">
                                    No tags created yet.
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-2 border-t border-slate-100 bg-slate-50/70 px-6 py-4">
                <button type="button" @click="openTag = false;$wire.clearForm()"
                    class="rounded-lg px-4 py-2 text-sm font-medium text-slate-600
                       transition hover:bg-slate-100
                       hover:text-slate-900 cursor-pointer">
                    Cancel
                </button>

                <button type="submit"
                    class="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-medium
                       text-white shadow-sm transition
                       hover:bg-indigo-700
                       active:bg-indigo-800 cursor-pointer">
                    Done
                </button>
            </div>
        </form>
    </div>
</div>
