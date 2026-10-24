@props(['count'])

<div class="mb-8 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
    <div class="flex items-center justify-between">
        <div>
            <p class="text-sm font-medium text-slate-600">
                Recorded activities
            </p>

            <p class="mt-1 text-3xl font-bold text-slate-900">
                {{ $count }}
            </p>

            <p class="mt-1 text-sm text-slate-500">
                Your recent actions in one place.
            </p>
        </div>

        <div class="rounded-xl bg-indigo-100 p-3 text-indigo-700">
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="1.8">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 2m6-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
    </div>
</div>
