<?php

namespace App\View\Composers;

use App\Models\Project;
use Illuminate\View\View;

class ProjectComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $projects = Project::active()->ordered()->get();

        // Get unique categories for filter (flatten all categories arrays)
        $categories = $projects
            ->pluck('categories')
            ->flatten()
            ->unique()
            ->filter()
            ->values();

        $view->with([
            'projects' => $projects,
            'projectCategories' => $categories,
        ]);
    }
}
