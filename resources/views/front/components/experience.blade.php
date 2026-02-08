<section id="experience" class="py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 animate-on-scroll fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                Work <span class="text-cyan-400">Experience</span>
            </h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto rounded-full divider-glow"></div>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                My professional journey and the companies I've worked with
            </p>
        </div>

        <!-- Timeline -->
        <div class="relative">
            <!-- Timeline Line -->
            <div class="absolute left-0 md:left-1/2 transform md:-translate-x-px h-full w-0.5 bg-slate-700 timeline-line-animated"></div>

            <!-- Experience Items -->
            <div class="space-y-12">
                @php
                    $colorClasses = [
                        'cyan' => ['bg' => 'bg-cyan-500/10', 'text' => 'text-cyan-400', 'dot' => 'bg-cyan-400', 'hover' => 'hover:border-cyan-400/50'],
                        'purple' => ['bg' => 'bg-purple-500/10', 'text' => 'text-purple-400', 'dot' => 'bg-purple-400', 'hover' => 'hover:border-purple-400/50'],
                        'green' => ['bg' => 'bg-green-500/10', 'text' => 'text-green-400', 'dot' => 'bg-green-400', 'hover' => 'hover:border-green-400/50'],
                        'orange' => ['bg' => 'bg-orange-500/10', 'text' => 'text-orange-400', 'dot' => 'bg-orange-400', 'hover' => 'hover:border-orange-400/50'],
                        'blue' => ['bg' => 'bg-blue-500/10', 'text' => 'text-blue-400', 'dot' => 'bg-blue-400', 'hover' => 'hover:border-blue-400/50'],
                        'pink' => ['bg' => 'bg-pink-500/10', 'text' => 'text-pink-400', 'dot' => 'bg-pink-400', 'hover' => 'hover:border-pink-400/50'],
                    ];
                @endphp

                @forelse($experiences as $index => $experience)
                @php
                    $color = $colorClasses[$experience->color] ?? $colorClasses['cyan'];
                    $isLeft = $index % 2 === 0;
                @endphp

                @if($isLeft)
                <!-- Left Side Experience -->
                <div class="relative flex flex-col md:flex-row items-start">
                    <div class="flex-1 md:pr-12 md:text-right order-2 md:order-1">
                        <div class="animate-on-scroll fade-right bg-slate-800/50 border border-slate-700 rounded-xl p-6 {{ $color['hover'] }} transition-all ml-8 md:ml-0">
                            <span class="inline-block px-3 py-1 {{ $color['bg'] }} {{ $color['text'] }} text-sm font-medium rounded-full mb-3">
                                {{ $experience->date_range }}
                            </span>
                            <h3 class="text-xl font-semibold text-white mb-2">{{ $experience->position }}</h3>
                            <h4 class="{{ $color['text'] }} font-medium mb-3">{{ $experience->company }}</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                {{ $experience->description }}
                            </p>
                            @if($experience->technologies && count($experience->technologies) > 0)
                            <div class="flex flex-wrap gap-2 mt-4 md:justify-end">
                                @foreach($experience->technologies as $tech)
                                <span class="px-2 py-1 bg-slate-700/50 text-slate-300 rounded text-xs">{{ $tech }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                    <!-- Timeline Dot -->
                    <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 w-4 h-4 {{ $color['dot'] }} rounded-full border-4 border-slate-950 z-10 animate-on-scroll scale-in timeline-dot-animated"></div>
                    <div class="flex-1 md:pl-12 order-1 md:order-2"></div>
                </div>
                @else
                <!-- Right Side Experience -->
                <div class="relative flex flex-col md:flex-row items-start">
                    <div class="flex-1 md:pr-12 order-2 md:order-1"></div>
                    <!-- Timeline Dot -->
                    <div class="absolute left-0 md:left-1/2 transform -translate-x-1/2 w-4 h-4 {{ $color['dot'] }} rounded-full border-4 border-slate-950 z-10 animate-on-scroll scale-in timeline-dot-animated"></div>
                    <div class="flex-1 md:pl-12 order-1 md:order-2">
                        <div class="animate-on-scroll fade-left bg-slate-800/50 border border-slate-700 rounded-xl p-6 {{ $color['hover'] }} transition-all ml-8 md:ml-0">
                            <span class="inline-block px-3 py-1 {{ $color['bg'] }} {{ $color['text'] }} text-sm font-medium rounded-full mb-3">
                                {{ $experience->date_range }}
                            </span>
                            <h3 class="text-xl font-semibold text-white mb-2">{{ $experience->position }}</h3>
                            <h4 class="{{ $color['text'] }} font-medium mb-3">{{ $experience->company }}</h4>
                            <p class="text-slate-400 text-sm leading-relaxed">
                                {{ $experience->description }}
                            </p>
                            @if($experience->technologies && count($experience->technologies) > 0)
                            <div class="flex flex-wrap gap-2 mt-4">
                                @foreach($experience->technologies as $tech)
                                <span class="px-2 py-1 bg-slate-700/50 text-slate-300 rounded text-xs">{{ $tech }}</span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endif

                @empty
                <div class="text-center text-slate-400">
                    No experience data available.
                </div>
                @endforelse
            </div>
        </div>
    </div>
</section>
