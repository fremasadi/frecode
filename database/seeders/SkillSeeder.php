<?php

namespace Database\Seeders;

use App\Models\Skill;
use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'frontend' => [
                ['name' => 'HTML5', 'level' => 95, 'order' => 1],
                ['name' => 'CSS3', 'level' => 90, 'order' => 2],
                ['name' => 'JavaScript', 'level' => 88, 'order' => 3],
                ['name' => 'TypeScript', 'level' => 80, 'order' => 4],
                ['name' => 'React', 'level' => 85, 'order' => 5],
                ['name' => 'Vue.js', 'level' => 82, 'order' => 6],
                ['name' => 'Next.js', 'level' => 78, 'order' => 7],
                ['name' => 'Tailwind CSS', 'level' => 92, 'order' => 8],
            ],
            'backend' => [
                ['name' => 'PHP', 'level' => 88, 'order' => 1],
                ['name' => 'Laravel', 'level' => 90, 'order' => 2],
                ['name' => 'Node.js', 'level' => 82, 'order' => 3],
                ['name' => 'Express.js', 'level' => 80, 'order' => 4],
                ['name' => 'Python', 'level' => 70, 'order' => 5],
                ['name' => 'REST API', 'level' => 92, 'order' => 6],
                ['name' => 'GraphQL', 'level' => 75, 'order' => 7],
            ],
            'database' => [
                ['name' => 'MySQL', 'level' => 88, 'order' => 1],
                ['name' => 'PostgreSQL', 'level' => 82, 'order' => 2],
                ['name' => 'MongoDB', 'level' => 78, 'order' => 3],
                ['name' => 'Redis', 'level' => 75, 'order' => 4],
                ['name' => 'SQLite', 'level' => 85, 'order' => 5],
            ],
            'devops' => [
                ['name' => 'Git', 'level' => 92, 'order' => 1],
                ['name' => 'Docker', 'level' => 80, 'order' => 2],
                ['name' => 'AWS', 'level' => 72, 'order' => 3],
                ['name' => 'CI/CD', 'level' => 78, 'order' => 4],
                ['name' => 'Linux', 'level' => 85, 'order' => 5],
                ['name' => 'Nginx', 'level' => 80, 'order' => 6],
            ],
            'mobile' => [
                ['name' => 'Flutter', 'level' => 90, 'order' => 1],
                ['name' => 'React Native', 'level' => 78, 'order' => 2],
                ['name' => 'PWA', 'level' => 82, 'order' => 3],
            ],
            'other' => [
                ['name' => 'Agile/Scrum', 'level' => 85, 'order' => 1],
                ['name' => 'Figma', 'level' => 75, 'order' => 2],
                ['name' => 'Testing', 'level' => 80, 'order' => 3],
                ['name' => 'Clean Code', 'level' => 88, 'order' => 4],
            ],
        ];

        foreach ($skills as $categorySlug => $categorySkills) {
            $category = SkillCategory::where('slug', $categorySlug)->first();

            if ($category) {
                foreach ($categorySkills as $skill) {
                    Skill::create([
                        'skill_category_id' => $category->id,
                        'name' => $skill['name'],
                        'level' => $skill['level'],
                        'order' => $skill['order'],
                    ]);
                }
            }
        }
    }
}
