@php
    if (!isset($scrollTo)) {
        $scrollTo = 'body';
    }

    $scrollIntoViewJsSnippet =
        $scrollTo !== false
            ? "(\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()"
            : '';

    $buttonClass =
        'inline-flex items-center justify-center gap-2 rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white shadow-md transition-all duration-200 hover:bg-indigo-700 hover:shadow-lg hover:-translate-y-0.5 active:translate-y-0 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2';

    $disabledClass =
        'inline-flex items-center justify-center gap-2 rounded-full bg-indigo-600 px-5 py-3 text-sm font-semibold text-white opacity-40 cursor-not-allowed';
@endphp

<div class="mt-10 mb-40 flex items-center justify-center">
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-4">

            {{-- Previous Button --}}
            @if ($paginator->onFirstPage())
                <span class="{{ $disabledClass }}">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                @if (method_exists($paginator, 'getCursorName'))
                    @php($previousCursor = $paginator->previousCursor() ?? $paginator->cursor())

                    <button type="button" dusk="previousPage"
                        wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $previousCursor?->encode() }}"
                        wire:click="setPage('{{ $previousCursor?->encode() }}','{{ $paginator->getCursorName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                        class="{{ $buttonClass }}">
                        {!! __('pagination.previous') !!}
                    </button>
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                        dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="{{ $buttonClass }}">
                        {!! __('pagination.previous') !!}
                    </button>
                @endif
            @endif

            {{-- Next Button --}}
            @if ($paginator->hasMorePages())
                @if (method_exists($paginator, 'getCursorName'))
                    @php($nextCursor = $paginator->nextCursor() ?? $paginator->cursor())

                    <button type="button" dusk="nextPage"
                        wire:key="cursor-{{ $paginator->getCursorName() }}-{{ $nextCursor?->encode() }}"
                        wire:click="setPage('{{ $nextCursor?->encode() }}','{{ $paginator->getCursorName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                        class="{{ $buttonClass }}">
                        {!! __('pagination.next') !!}
                    </button>
                @else
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
                        x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
                        dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}"
                        class="{{ $buttonClass }}">
                        {!! __('pagination.next') !!}
                    </button>
                @endif
            @else
                <span class="{{ $disabledClass }}">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </nav>
    @endif
</div>
