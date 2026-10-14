<?php

use Livewire\Component;

new class extends Component {
    //
};
?>

<layouts::app title="Luma Notes">
    <div class="min-h-screen bg-white text-slate-900">
        <header class="border-b border-slate-100">
            <x-home.navigation />
        </header>
        <main>
            <x-home.hero />
            <x-home.features />
            <x-home.how-it-works />
            <x-home.call-to-action />
        </main>
        <x-home.footer />
    </div>
</layouts::app>
