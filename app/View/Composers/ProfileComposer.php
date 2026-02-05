<?php

namespace App\View\Composers;

use App\Models\Profile;
use Illuminate\View\View;

class ProfileComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('profile', Profile::first());
    }
}
