<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profile::create([
            // Hero Section
            'name' => 'Fremas Adi',
            'title' => 'Fullstack Developer',
            'subtitle' => "Hello, I'm",
            'hero_description' => 'I build exceptional digital experiences with modern technologies. Passionate about creating scalable web applications and elegant solutions.',
            'profile_image' => null, // Will be uploaded via admin

            // About Section
            'about_description' => "I'm a Fullstack Developer with over 5 years of experience in building web applications. I specialize in JavaScript/TypeScript ecosystems, working with modern frameworks like React, Vue.js, and Node.js on the frontend, and Laravel, Express.js on the backend.",
            'about_description_2' => "I'm passionate about writing clean, maintainable code and creating seamless user experiences. I believe in continuous learning and staying updated with the latest technologies and best practices in the ever-evolving world of web development.",
            'years_experience' => 5,
            'projects_completed' => 50,
            'happy_clients' => 30,

            // Contact Info
            'email' => 'john@example.com',
            'phone' => '+62 812 3456 7890',
            'location' => 'Jakarta, Indonesia',
            'availability_status' => 'Available for Work',

            // CV
            'cv_file' => null, // Will be uploaded via admin

            // Social Links
            'github_url' => 'https://github.com',
            'linkedin_url' => 'https://linkedin.com',
            'twitter_url' => 'https://twitter.com',
            'instagram_url' => 'https://instagram.com',
        ]);
    }
}
