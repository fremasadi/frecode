<section id="about" class="py-20 bg-slate-900/50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 animate-on-scroll fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                About <span class="text-cyan-400">Me</span>
            </h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto rounded-full divider-glow"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Stats Cards -->
            <div class="space-y-8">
                <div class="grid grid-cols-2 gap-4" data-stagger>
                    <div class="animate-on-scroll scale-in bg-slate-800/50 border border-slate-700 rounded-xl p-6 text-center hover:border-cyan-400/50 transition-colors">
                        <div class="text-4xl font-bold text-cyan-400 mb-2" data-counter="{{ $profile?->years_experience ?? 0 }}" data-counter-suffix="+">0+</div>
                        <div class="text-slate-400 text-sm">Years Experience</div>
                    </div>
                    <div class="animate-on-scroll scale-in bg-slate-800/50 border border-slate-700 rounded-xl p-6 text-center hover:border-cyan-400/50 transition-colors">
                        <div class="text-4xl font-bold text-cyan-400 mb-2" data-counter="{{ $profile?->projects_completed ?? 0 }}" data-counter-suffix="+">0+</div>
                        <div class="text-slate-400 text-sm">Projects Completed</div>
                    </div>
                    <div class="animate-on-scroll scale-in bg-slate-800/50 border border-slate-700 rounded-xl p-6 text-center hover:border-cyan-400/50 transition-colors">
                        <div class="text-4xl font-bold text-cyan-400 mb-2" data-counter="{{ $profile?->happy_clients ?? 0 }}" data-counter-suffix="+">0+</div>
                        <div class="text-slate-400 text-sm">Happy Clients</div>
                    </div>
                    <div class="animate-on-scroll scale-in bg-slate-800/50 border border-slate-700 rounded-xl p-6 text-center hover:border-cyan-400/50 transition-colors">
                        <div class="text-4xl font-bold text-cyan-400 mb-2" data-counter="10" data-counter-suffix="+">0+</div>
                        <div class="text-slate-400 text-sm">Technologies</div>
                    </div>
                </div>
            </div>

            <!-- Text Content -->
            <div class="space-y-6 animate-on-scroll fade-right">
                <h3 class="text-2xl font-semibold text-white">
                    A passionate developer who loves building things
                </h3>
                <p class="text-slate-400 leading-relaxed">
                    {{ $profile?->about_description ?? "I'm a Fullstack Developer with experience in building web applications." }}
                </p>
                @if($profile?->about_description_2)
                <p class="text-slate-400 leading-relaxed">
                    {{ $profile->about_description_2 }}
                </p>
                @endif

                <!-- Info List -->
                <div class="grid sm:grid-cols-2 gap-4 pt-4">
                    <div class="flex items-center gap-3">
                        <span class="text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <span class="text-slate-300">{{ $profile?->name ?? 'Your Name' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <span class="text-slate-300">{{ $profile?->email ?? 'email@example.com' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                        </span>
                        <span class="text-slate-300">{{ $profile?->location ?? 'Your Location' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-cyan-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <span class="text-slate-300">{{ $profile?->availability_status ?? 'Available for Work' }}</span>
                    </div>
                </div>

                <!-- Download CV Button -->
                @if($profile?->cv_file)
                <div class="pt-4">
                    <a href="{{ Storage::url($profile->cv_file) }}" download class="inline-flex items-center gap-2 px-6 py-3 bg-cyan-500 hover:bg-cyan-600 text-slate-900 font-semibold rounded-lg transition-all hover:shadow-lg hover:shadow-cyan-500/25">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Download CV
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
