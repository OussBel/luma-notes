<section class="relative overflow-hidden">
    <div class="absolute inset-0 -z-10 bg-gradient-to-b from-indigo-50 via-white to-white"></div>

    <div class="mx-auto max-w-4xl px-6 py-24 text-center sm:py-32 lg:px-8">
        <div
            class="mb-6 inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-white px-4 py-2
             text-base font-medium text-indigo-700 shadow-sm">
            <span class="h-2 w-2 rounded-full bg-indigo-500"></span>
            A calmer way to stay organized
        </div>

        <h1 class="text-5xl font-bold leading-tight tracking-tight sm:text-6xl lg:text-7xl">
            Your thoughts,
            <span class="text-indigo-600">beautifully</span>
            organized.
        </h1>

        <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-slate-600">
            Capture your ideas, organize your tasks, and keep track of what matters.
            Luma Notes makes it easier to turn scattered thoughts into clear plans.
        </p>

        <div class="mt-9 flex flex-col justify-center gap-4 sm:flex-row">
            <a href="{{ route('register') }}" wire:navigate
                class="inline-flex items-center justify-center gap-2 rounded-xl bg-indigo-600 px-6 py-3.5
                 font-semibold text-white shadow-lg shadow-indigo-200 transition 
                 hover:-translate-y-0.5 hover:bg-indigo-700">
                Start using Luma notes
                <span aria-hidden="true">&rarr;</span>
            </a>

            <a href="#features"
                class="inline-flex items-center justify-center rounded-xl border border-slate-200 bg-white
                 px-6 py-3.5 font-semibold text-slate-700 transition hover:bg-slate-50">
                Explore features
            </a>
        </div>

        <p class="mt-8 text-base text-slate-500">
            A little more clarity, every day.
        </p>
    </div>
</section>
