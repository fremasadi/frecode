<?php

namespace App\View\Composers;

use App\Models\SkillCategory;
use Illuminate\View\View;

class SkillComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $skillCategories = SkillCategory::with(['skills' => function ($query) {
            $query->active()->ordered();
        }])
            ->active()
            ->ordered()
            ->get();

        $view->with('skillCategories', $skillCategories);
    }
}
