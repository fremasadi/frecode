<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // Hero Section
            $table->string('name');
            $table->string('title')->nullable(); // e.g., "Fullstack Developer"
            $table->string('subtitle')->nullable(); // e.g., "Hello, I'm"
            $table->text('hero_description')->nullable();
            $table->string('profile_image')->nullable();

            // About Section
            $table->text('about_description')->nullable();
            $table->text('about_description_2')->nullable();
            $table->integer('years_experience')->default(0);
            $table->integer('projects_completed')->default(0);
            $table->integer('happy_clients')->default(0);

            // Contact Info
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('availability_status')->default('Available for Work');

            // CV
            $table->string('cv_file')->nullable();

            // Social Links
            $table->string('github_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('instagram_url')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
