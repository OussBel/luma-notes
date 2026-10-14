 <nav class="mx-auto flex max-w-7xl items-center justify-between px-6 py-5 lg:px-8">
     <a href="/" class="flex items-center gap-3">
         <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-600 text-xl font-bold text-white">
             L
         </div>
         <span class="text-xl font-bold tracking-tight">
             Luma <span class="text-indigo-600">Notes</span>
         </span>
     </a>

     <div class="hidden items-center gap-8 text-base font-medium text-slate-600 md:flex">
         <a href="#features" class="transition hover:text-indigo-600">Features</a>
         <a href="#how-it-works" class="transition hover:text-indigo-600">How it works</a>
     </div>

     <div class="flex items-center gap-3">
         <a href="{{ route('login') }}" wire:navigate
             class="rounded-lg px-4 py-2.5 text-base font-semibold text-slate-700 transition hover:bg-slate-100">
             Log in
         </a>

         <a href="{{ route('register') }}" wire:navigate
             class="rounded-lg bg-indigo-600 px-4 py-2.5 text-base font-semibold text-white shadow-sm 
             transition hover:bg-indigo-700">
             Get started
         </a>
     </div>
 </nav>
