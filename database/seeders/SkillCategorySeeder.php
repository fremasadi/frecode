<?php

namespace Database\Seeders;

use App\Models\SkillCategory;
use Illuminate\Database\Seeder;

class SkillCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Frontend',
                'slug' => 'frontend',
                'color' => 'cyan',
                'order' => 1,
            ],
            [
                'name' => 'Backend',
                'slug' => 'backend',
                'color' => 'purple',
                'order' => 2,
            ],
            [
                'name' => 'Database',
                'slug' => 'database',
                'color' => 'green',
                'order' => 3,
            ],
            [
                'name' => 'DevOps & Tools',
                'slug' => 'devops',
                'color' => 'orange',
                'order' => 4,
            ],
            [
                'name' => 'Mobile',
                'slug' => 'mobile',
                'color' => 'blue',
                'order' => 5,
            ],
            [
                'name' => 'Other',
                'slug' => 'other',
                'color' => 'pink',
                'order' => 6,
            ],
        ];

        foreach ($categories as $category) {
            SkillCategory::create($category);
        }
    }
}
