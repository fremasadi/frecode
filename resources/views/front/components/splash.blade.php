<!-- Modern Splash Screen -->
<div id="splash-screen" class="fixed inset-0 z-[100] bg-slate-950">
    <!-- Animated Background Gradient -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Gradient Orbs -->
        <div class="splash-orb splash-orb-1"></div>
        <div class="splash-orb splash-orb-2"></div>
        <div class="splash-orb splash-orb-3"></div>

        <!-- Grid Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: linear-gradient(#22d3ee 1px, transparent 1px), linear-gradient(90deg, #22d3ee 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>
    </div>

    <!-- Center Content -->
    <div class="relative h-full flex flex-col items-center justify-center z-10">
        <!-- Logo Circle -->
        <div class="splash-logo-circle mb-8">
            <div class="splash-logo-inner">
                <svg class="w-16 h-16 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
        </div>

        <!-- Name with Letter Animation -->
        <div class="splash-name-container mb-3">
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white tracking-tight">
                @php
                    $name = $profile?->name ?? 'Fremas Adi';
                    $letters = mb_str_split($name);
                @endphp
                @foreach($letters as $index => $letter)
                    <span class="splash-letter" style="animation-delay: {{ $index * 0.05 }}s">{{ $letter === ' ' ? ';' : $letter }}</span>
                @endforeach
            </h1>
        </div>

        <!-- Animated Title -->
        <p class="splash-subtitle text-xl sm:text-2xl font-medium mb-8">
            <span class="splash-gradient-text">{{ $profile?->title ?? 'Fullstack Developer' }}</span>
        </p>

        <!-- Loading Bar -->
        <div class="splash-loader-container">
            <div class="splash-loader-bar"></div>
        </div>

        <!-- Percentage Counter -->
        <div class="splash-percentage mt-4 text-cyan-400 font-mono text-sm">
            <span id="splash-percent">0</span>%
        </div>
    </div>
</div>

<script>
// Splash screen percentage counter
(function() {
    const percentEl = document.getElementById('splash-percent');
    if (!percentEl) return;

    let percent = 0;
    const interval = setInterval(() => {
        percent += Math.random() * 15;
        if (percent >= 100) {
            percent = 100;
            clearInterval(interval);
        }
        percentEl.textContent = Math.floor(percent);
    }, 80);
})();
</script>
