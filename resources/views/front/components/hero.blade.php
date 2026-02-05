<section id="home" class="min-h-screen flex items-center justify-center pt-16 relative overflow-hidden">
    <!-- Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-950 via-slate-900 to-slate-950"></div>
    <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-cyan-500/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-500/10 rounded-full blur-3xl"></div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="grid lg:grid-cols-2 gap-8 lg:gap-12 items-center">
            <!-- Profile Image (Mobile: First, Desktop: Second) -->
            <div class="flex justify-center items-center order-first lg:order-last mb-6 lg:mb-0">
                <div class="relative">
                    <div class="w-64 h-64 lg:w-96 lg:h-96 bg-gradient-to-br from-cyan-500 to-purple-600 opacity-20 absolute blur-3xl"></div>
                    <img
                        src="{{ $profile?->profile_image ? Storage::url($profile->profile_image) : asset('assets/images/profile.png') }}"
                        alt="{{ $profile?->name ?? 'Profile' }}"
                        class="relative w-48 sm:w-56 lg:w-80 h-auto object-contain drop-shadow-2xl"
                    />
                </div>
            </div>

            <!-- Text Content -->
            <div class="text-center lg:text-left order-last lg:order-first">
                <p class="text-cyan-400 font-medium mb-4 tracking-wide">{{ $profile?->subtitle ?? "Hello, I'm" }}</p>
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-4">
                    {{ $profile?->name ?? 'Your Name' }}
                </h1>
                <h2 class="text-2xl sm:text-3xl font-semibold text-slate-400 mb-6">
                    <span class="text-cyan-400">{{ Str::before($profile?->title ?? 'Fullstack Developer', ' ') }}</span> {{ Str::after($profile?->title ?? 'Fullstack Developer', ' ') }}
                </h2>
                <p class="text-slate-400 text-lg mb-8 max-w-lg mx-auto lg:mx-0">
                    {{ $profile?->hero_description ?? 'I build exceptional digital experiences with modern technologies.' }}
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="#projects" class="px-8 py-3 bg-cyan-500 hover:bg-cyan-600 text-slate-900 font-semibold rounded-lg transition-all hover:shadow-lg hover:shadow-cyan-500/25">
                        View Projects
                    </a>
                    <a href="#contact" class="px-8 py-3 border border-slate-600 hover:border-cyan-400 text-white font-semibold rounded-lg transition-all hover:text-cyan-400">
                        Get In Touch
                    </a>
                </div>

                <!-- Social Links -->
                <div class="flex gap-4 mt-8 justify-center lg:justify-start">
                    @if($profile?->github_url)
                    <a href="{{ $profile->github_url }}" target="_blank" class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors group" aria-label="GitHub">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                    @endif
                    @if($profile?->linkedin_url)
                    <a href="{{ $profile->linkedin_url }}" target="_blank" class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors group" aria-label="LinkedIn">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    @endif
                    {{-- @if($profile?->twitter_url)
                    <a href="{{ $profile->twitter_url }}" target="_blank" class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors group" aria-label="Twitter">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    @endif --}}
                    @if($profile?->instagram_url)
                    <a href="{{ $profile->instagram_url }}" target="_blank" class="p-3 bg-slate-800 hover:bg-slate-700 rounded-lg transition-colors group" aria-label="Instagram">
                        <svg class="w-5 h-5 text-slate-400 group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </a>
                    @endif
                </div>
            </div>

        </div>

        <!-- Scroll Indicator -->
        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
            <a href="#about" class="text-slate-500 hover:text-cyan-400 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </a>
        </div>
    </div>
</section>
