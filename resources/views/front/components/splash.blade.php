<!-- Splash Screen -->
<div id="splash-screen" class="fixed inset-0 z-[100] flex items-center justify-center bg-slate-950">
    <!-- Background Effects -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="splash-particle splash-particle-1"></div>
        <div class="splash-particle splash-particle-2"></div>
        <div class="splash-particle splash-particle-3"></div>
        <div class="splash-particle splash-particle-4"></div>
    </div>

    <!-- Center Content -->
    <div class="relative text-center z-10">
        <!-- Glowing Line Above -->
        <div class="splash-line mx-auto mb-6"></div>

        <!-- Name -->
        <h1 class="splash-name text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-3">
            {{ $profile?->name ?? 'Fremas Adi' }}
        </h1>

        <!-- Title -->
        <p class="splash-title text-lg sm:text-xl text-cyan-400 font-medium tracking-widest uppercase">
            {{ $profile?->title ?? 'Fullstack Developer' }}
        </p>

        <!-- Glowing Line Below -->
        <div class="splash-line mx-auto mt-6"></div>
    </div>
</div>
