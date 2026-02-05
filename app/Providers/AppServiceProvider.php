<?php

namespace App\Providers;

use App\View\Composers\ExperienceComposer;
use App\View\Composers\ProfileComposer;
use App\View\Composers\ProjectComposer;
use App\View\Composers\SkillComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Profile data for hero, about, contact, footer
        View::composer([
            'front.components.hero',
            'front.components.about',
            'front.components.contact',
            'front.components.footer',
            'front.components.navbar',
        ], ProfileComposer::class);

        // Skills data
        View::composer('front.components.skills', SkillComposer::class);

        // Projects data
        View::composer('front.components.projects', ProjectComposer::class);

        // Experiences data
        View::composer('front.components.experience', ExperienceComposer::class);
    }
}
