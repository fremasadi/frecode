<section id="skills" class="py-20">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16 animate-on-scroll fade-up">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                My <span class="text-cyan-400">Skills</span>
            </h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto rounded-full divider-glow"></div>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Technologies and tools I use to bring ideas to life. Click on each category to see proficiency levels.
            </p>
        </div>

        <!-- Skills Categories -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" data-stagger>
            @forelse($skillCategories as $category)
            @php
                $colorClasses = [
                    'cyan' => ['bg' => 'bg-cyan-500/10', 'hover' => 'hover:border-cyan-400/50', 'text' => 'text-cyan-400', 'hoverBg' => 'group-hover:bg-cyan-500/20'],
                    'purple' => ['bg' => 'bg-purple-500/10', 'hover' => 'hover:border-purple-400/50', 'text' => 'text-purple-400', 'hoverBg' => 'group-hover:bg-purple-500/20'],
                    'green' => ['bg' => 'bg-green-500/10', 'hover' => 'hover:border-green-400/50', 'text' => 'text-green-400', 'hoverBg' => 'group-hover:bg-green-500/20'],
                    'orange' => ['bg' => 'bg-orange-500/10', 'hover' => 'hover:border-orange-400/50', 'text' => 'text-orange-400', 'hoverBg' => 'group-hover:bg-orange-500/20'],
                    'blue' => ['bg' => 'bg-blue-500/10', 'hover' => 'hover:border-blue-400/50', 'text' => 'text-blue-400', 'hoverBg' => 'group-hover:bg-blue-500/20'],
                    'pink' => ['bg' => 'bg-pink-500/10', 'hover' => 'hover:border-pink-400/50', 'text' => 'text-pink-400', 'hoverBg' => 'group-hover:bg-pink-500/20'],
                ];
                $color = $colorClasses[$category->color] ?? $colorClasses['cyan'];
                $skillsJson = $category->skills->map(fn($s) => ['name' => $s->name, 'level' => $s->level])->toJson();
            @endphp
            <div class="skill-card animate-on-scroll fade-up bg-slate-800/50 border border-slate-700 rounded-xl p-6 {{ $color['hover'] }} transition-all group cursor-pointer"
                 data-category="{{ $category->slug }}"
                 data-skills='{{ $skillsJson }}'
                 data-color="{{ $category->color }}">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-3 {{ $color['bg'] }} rounded-lg {{ $color['hoverBg'] }} transition-colors">
                            <svg class="w-6 h-6 {{ $color['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-white">{{ $category->name }}</h3>
                    </div>
                    <svg class="w-5 h-5 text-slate-500 group-hover:{{ $color['text'] }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($category->skills as $skill)
                    <span class="px-3 py-1.5 bg-slate-700/50 text-slate-300 rounded-lg text-sm">{{ $skill->name }}</span>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-slate-400">
                No skills data available.
            </div>
            @endforelse
        </div>
    </div>

    <!-- Skills Modal -->
    <div id="skills-modal" class="fixed inset-0 z-50 hidden items-center justify-center p-4">
        <!-- Backdrop -->
        <div class="absolute inset-0 bg-slate-950/80 backdrop-blur-sm" id="modal-backdrop"></div>

        <!-- Modal Content -->
        <div class="relative bg-slate-900 border border-slate-700 rounded-2xl w-full max-w-lg max-h-[80vh] overflow-hidden shadow-2xl transform transition-all">
            <!-- Modal Header -->
            <div class="flex items-center justify-between p-6 border-b border-slate-700">
                <h3 id="modal-title" class="text-xl font-semibold text-white">Skills</h3>
                <button id="modal-close" class="p-2 text-slate-400 hover:text-white transition-colors rounded-lg hover:bg-slate-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[60vh]">
                <div id="modal-skills" class="space-y-5">
                    <!-- Skills will be injected here -->
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('skills-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalSkills = document.getElementById('modal-skills');
    const modalBackdrop = document.getElementById('modal-backdrop');
    const modalClose = document.getElementById('modal-close');

    const colorClasses = {
        cyan: 'bg-cyan-500',
        purple: 'bg-purple-500',
        green: 'bg-green-500',
        orange: 'bg-orange-500',
        blue: 'bg-blue-500',
        pink: 'bg-pink-500'
    };

    const textColorClasses = {
        cyan: 'text-cyan-400',
        purple: 'text-purple-400',
        green: 'text-green-400',
        orange: 'text-orange-400',
        blue: 'text-blue-400',
        pink: 'text-pink-400'
    };

    // Open modal
    document.querySelectorAll('.skill-card').forEach(card => {
        card.addEventListener('click', function() {
            const category = this.dataset.category;
            const skills = JSON.parse(this.dataset.skills);
            const color = this.dataset.color;

            // Set title
            modalTitle.textContent = this.querySelector('h3').textContent + ' Skills';
            modalTitle.className = `text-xl font-semibold ${textColorClasses[color]}`;

            // Generate skill bars
            modalSkills.innerHTML = skills.map(skill => `
                <div class="space-y-2">
                    <div class="flex justify-between items-center">
                        <span class="text-white font-medium">${skill.name}</span>
                        <span class="${textColorClasses[color]} font-semibold">${skill.level}%</span>
                    </div>
                    <div class="h-3 bg-slate-800 rounded-full overflow-hidden">
                        <div class="skill-bar h-full ${colorClasses[color]} rounded-full transition-all duration-1000 ease-out" style="width: 0%" data-level="${skill.level}"></div>
                    </div>
                </div>
            `).join('');

            // Show modal
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';

            // Animate skill bars
            setTimeout(() => {
                document.querySelectorAll('.skill-bar').forEach(bar => {
                    bar.style.width = bar.dataset.level + '%';
                });
            }, 100);
        });
    });

    // Close modal
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = '';
    }

    modalBackdrop.addEventListener('click', closeModal);
    modalClose.addEventListener('click', closeModal);

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
});
</script>
