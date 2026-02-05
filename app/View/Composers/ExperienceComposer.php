<?php

namespace App\View\Composers;

use App\Models\Experience;
use Illuminate\View\View;

class ExperienceComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $experiences = Experience::active()->ordered()->get();

        $view->with('experiences', $experiences);
    }
}
