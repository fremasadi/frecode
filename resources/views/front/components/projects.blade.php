<section id="projects" class="py-20 bg-slate-900/50">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">
                My <span class="text-cyan-400">Projects</span>
            </h2>
            <div class="w-20 h-1 bg-cyan-400 mx-auto rounded-full"></div>
            <p class="text-slate-400 mt-4 max-w-2xl mx-auto">
                Here are some of my recent projects that showcase my skills and experience
            </p>
        </div>

        <!-- Project Filters -->
        <div class="flex flex-wrap justify-center gap-3 mb-12">
            <button class="filter-btn px-4 py-2 bg-cyan-500 text-slate-900 font-medium rounded-lg transition-all" data-filter="all">All</button>
            @foreach($projectCategories as $category)
            <button class="filter-btn px-4 py-2 bg-slate-800 text-slate-300 hover:bg-slate-700 font-medium rounded-lg transition-all" data-filter="{{ $category }}">{{ ucfirst($category) }}</button>
            @endforeach
        </div>

        <!-- Projects Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="projects-grid">
            @forelse($projects as $index => $project)
            <div class="project-card group bg-slate-800/50 border border-slate-700 rounded-xl overflow-hidden hover:border-cyan-400/50 transition-all cursor-pointer"
                 data-categories="{{ json_encode($project->categories ?? []) }}"
                 data-project-index="{{ $index }}"
                 onclick="openProjectModal({{ $index }})">
                <div class="relative overflow-hidden">
                    @if($project->first_image_url)
                    <img src="{{ $project->first_image_url }}" alt="{{ $project->title }}" class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="h-48 bg-gradient-to-br from-cyan-500/20 to-purple-500/20 flex items-center justify-center">
                        <svg class="w-16 h-16 text-cyan-400/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    @endif
                    <!-- Image count badge -->
                    @if(count($project->images ?? []) > 1)
                    <div class="absolute top-2 right-2 px-2 py-1 bg-slate-900/80 text-white text-xs rounded-full flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        {{ count($project->images) }}
                    </div>
                    @endif
                    <!-- View Details Overlay -->
                    <div class="absolute inset-0 bg-slate-900/80 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <span class="px-4 py-2 bg-cyan-500 text-slate-900 font-medium rounded-lg flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                            View Details
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-semibold text-white mb-2">{{ $project->title }}</h3>
                    <p class="text-slate-400 text-sm mb-4 line-clamp-2">{{ $project->description }}</p>
                    <div class="flex flex-wrap gap-2">
                        @foreach(array_slice($project->technologies ?? [], 0, 4) as $tech)
                        <span class="px-2 py-1 bg-slate-700/50 text-cyan-400 rounded text-xs">{{ $tech }}</span>
                        @endforeach
                        @if(count($project->technologies ?? []) > 4)
                        <span class="px-2 py-1 bg-slate-700/50 text-slate-400 rounded text-xs">+{{ count($project->technologies) - 4 }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-slate-400">
                No projects available.
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Project Detail Modal - Full Screen -->
<div id="project-modal" class="fixed inset-0 z-50 hidden">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-slate-950/95" onclick="closeProjectModal()"></div>

    <!-- Modal Content - Full Screen -->
    <div class="relative h-full w-full flex flex-col lg:flex-row">
        <!-- Close Button -->
        <button onclick="closeProjectModal()" style="position: fixed; top: 20px; right: 20px; z-index: 60; padding: 12px; background: rgba(15,23,42,0.9); border-radius: 50%; color: white; border: none; cursor: pointer; transition: background 0.2s;" onmouseover="this.style.background='rgba(51,65,85,0.9)'" onmouseout="this.style.background='rgba(15,23,42,0.9)'">
            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>

        <!-- Image Gallery - Left Side (Vertical Scroll) -->
        <div id="modal-image-gallery" style="width: 100%; height: 50vh; background: #0f172a; overflow-y: auto; display: flex; flex-direction: column; gap: 8px; padding: 8px;">
            <!-- Images will be inserted here by JavaScript -->
        </div>

        <!-- Project Info - Right Side -->
        <div id="modal-info-container" style="width: 100%; height: 50vh; padding: 24px; overflow-y: auto; background: #1e293b;">
            <h2 id="modal-title" class="text-2xl lg:text-3xl font-bold text-white mb-4"></h2>

            <!-- Categories -->
            <div id="modal-categories" class="flex flex-wrap gap-2 mb-4"></div>

            <!-- Description -->
            <style>
                #modal-detail { color: #cbd5e1; font-size: 14px; line-height: 1.7; }
                #modal-detail p { margin-bottom: 12px; }
                #modal-detail ul, #modal-detail ol { margin-bottom: 12px; padding-left: 20px; }
                #modal-detail ul { list-style-type: disc; }
                #modal-detail ol { list-style-type: decimal; }
                #modal-detail li { margin-bottom: 4px; }
                #modal-detail strong, #modal-detail b { color: #f1f5f9; font-weight: 600; }
                #modal-detail em, #modal-detail i { font-style: italic; }
                #modal-detail s { text-decoration: line-through; }
                #modal-detail a { color: #22d3ee; text-decoration: underline; }
                #modal-detail a:hover { color: #67e8f9; }
            </style>
            <div id="modal-detail" class="mb-6"></div>

            <!-- Technologies -->
            <div class="mb-6">
                <h4 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-3">Technologies</h4>
                <div id="modal-technologies" class="flex flex-wrap gap-2"></div>
            </div>

            <!-- Links -->
            <div id="modal-links" class="flex flex-wrap gap-3" style="padding-bottom: 24px;"></div>
        </div>
    </div>
</div>

@php
$projectsJson = $projects->map(fn($project) => [
    'title' => $project->title,
    'description' => $project->description,
    'detail' => $project->detail,
    'images' => $project->image_urls,
    'categories' => $project->categories ?? [],
    'technologies' => $project->technologies ?? [],
    'demo_url' => $project->demo_url,
    'github_url' => $project->github_url,
]);
@endphp

<script>
// Project data for modal
const projectsData = @json($projectsJson);

let currentImages = [];

function openProjectModal(index) {
    const project = projectsData[index];
    const modal = document.getElementById('project-modal');

    // Set title
    document.getElementById('modal-title').textContent = project.title;

    // Set categories
    const categoriesContainer = document.getElementById('modal-categories');
    categoriesContainer.innerHTML = project.categories.map(cat => {
        const colors = {
            'web': 'bg-blue-500/20 text-blue-400',
            'mobile': 'bg-green-500/20 text-green-400',
            'api': 'bg-yellow-500/20 text-yellow-400',
            'desktop': 'bg-purple-500/20 text-purple-400'
        };
        return `<span class="px-3 py-1 ${colors[cat] || 'bg-slate-700 text-slate-300'} rounded-full text-sm font-medium">${cat.charAt(0).toUpperCase() + cat.slice(1)}</span>`;
    }).join('');

    // Set detail (or description if no detail)
    document.getElementById('modal-detail').innerHTML = project.detail || `<p>${project.description}</p>`;

    // Set technologies
    document.getElementById('modal-technologies').innerHTML = project.technologies.map(tech =>
        `<span class="px-3 py-1 bg-slate-700/50 text-cyan-400 rounded-lg text-sm">${tech}</span>`
    ).join('');

    // Set links
    const linksContainer = document.getElementById('modal-links');
    let linksHtml = '';
    if (project.demo_url && project.demo_url !== '#') {
        linksHtml += `
            <a href="${project.demo_url}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-cyan-500 hover:bg-cyan-400 text-slate-900 font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                Live Demo
            </a>
        `;
    }
    if (project.github_url && project.github_url !== '#') {
        linksHtml += `
            <a href="${project.github_url}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-700 hover:bg-slate-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                </svg>
                View Code
            </a>
        `;
    }
    linksContainer.innerHTML = linksHtml;

    // Setup image gallery
    currentImages = project.images || [];
    setupGallery();

    // Adjust layout for desktop (side by side) vs mobile (stacked)
    const galleryContainer = document.getElementById('modal-image-gallery');
    const infoContainer = document.getElementById('modal-info-container');

    if (window.innerWidth >= 1024) {
        // Desktop: side by side, full height
        galleryContainer.style.width = '55%';
        galleryContainer.style.height = '100vh';
        infoContainer.style.width = '45%';
        infoContainer.style.height = '100vh';
    } else {
        // Mobile: stacked
        galleryContainer.style.width = '100%';
        galleryContainer.style.height = '50vh';
        infoContainer.style.width = '100%';
        infoContainer.style.height = '50vh';
    }

    // Show modal
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeProjectModal() {
    const modal = document.getElementById('project-modal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
}

function setupGallery() {
    const galleryContainer = document.getElementById('modal-image-gallery');

    if (!currentImages || currentImages.length === 0) {
        galleryContainer.innerHTML = `
            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, rgba(6,182,212,0.2), rgba(168,85,247,0.2));">
                <svg style="width: 96px; height: 96px; color: rgba(6,182,212,0.5);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                </svg>
            </div>
        `;
        return;
    }

    // Create vertical gallery with all images
    galleryContainer.innerHTML = currentImages.map((img, i) => `
        <div style="flex-shrink: 0; width: 100%; border-radius: 8px; overflow: hidden; background: #1e293b;">
            <img src="${img}" alt="Project image ${i + 1}" style="width: 100%; height: auto; display: block; object-fit: cover;" onerror="this.parentElement.innerHTML='<div style=\\'padding: 40px; text-align: center; color: #64748b;\\'>Image not found</div>'">
        </div>
    `).join('');

    // Scroll to top when opening
    galleryContainer.scrollTop = 0;
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeProjectModal();
    }
});

// Filter functionality
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const projectCards = document.querySelectorAll('.project-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const filter = this.dataset.filter;

            filterBtns.forEach(b => {
                b.classList.remove('bg-cyan-500', 'text-slate-900');
                b.classList.add('bg-slate-800', 'text-slate-300');
            });
            this.classList.remove('bg-slate-800', 'text-slate-300');
            this.classList.add('bg-cyan-500', 'text-slate-900');

            projectCards.forEach(card => {
                const categories = JSON.parse(card.dataset.categories || '[]');
                if (filter === 'all' || categories.includes(filter)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>
