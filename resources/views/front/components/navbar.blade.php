<nav class="fixed top-0 left-0 right-0 z-50 bg-slate-950/80 backdrop-blur-md border-b border-slate-800">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="text-xl font-bold text-white hover:text-cyan-400 transition-colors">
                <span class="text-cyan-400">&lt;</span>Frecode<span class="text-cyan-400">/&gt;</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="#home" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium">Home</a>
                <a href="#about" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium">About</a>
                <a href="#skills" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium">Skills</a>
                <a href="#projects" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium">Projects</a>
                <a href="#experience" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium">Experience</a>
                <a href="#contact" class="px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-slate-900 font-semibold rounded-lg transition-colors text-sm">Contact Me</a>
            </div>

            <!-- Mobile Menu Button -->
            <button type="button" class="md:hidden p-2 text-slate-300 hover:text-white" id="mobile-menu-btn" aria-label="Toggle menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div class="hidden md:hidden pb-4" id="mobile-menu">
            <div class="flex flex-col space-y-3">
                <a href="#home" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium py-2">Home</a>
                <a href="#about" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium py-2">About</a>
                <a href="#skills" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium py-2">Skills</a>
                <a href="#projects" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium py-2">Projects</a>
                <a href="#experience" class="text-slate-300 hover:text-cyan-400 transition-colors text-sm font-medium py-2">Experience</a>
                <a href="#contact" class="px-4 py-2 bg-cyan-500 hover:bg-cyan-600 text-slate-900 font-semibold rounded-lg transition-colors text-sm text-center">Contact Me</a>
            </div>
        </div>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>
