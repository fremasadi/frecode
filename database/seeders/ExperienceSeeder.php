<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $experiences = [
            [
                'position' => 'Senior Fullstack Developer',
                'company' => 'Tech Company Inc.',
                'description' => 'Leading development of microservices architecture, mentoring junior developers, and implementing CI/CD pipelines. Reduced deployment time by 60% and improved application performance by 40%.',
                'technologies' => ['React', 'Node.js', 'AWS'],
                'start_date' => '2022-01-01',
                'end_date' => null,
                'is_current' => true,
                'color' => 'cyan',
                'order' => 1,
            ],
            [
                'position' => 'Fullstack Developer',
                'company' => 'Digital Agency XYZ',
                'description' => 'Developed and maintained multiple client projects including e-commerce platforms, CMS systems, and custom web applications. Collaborated with design team to implement pixel-perfect UI components.',
                'technologies' => ['Laravel', 'Vue.js', 'MySQL'],
                'start_date' => '2020-01-01',
                'end_date' => '2021-12-31',
                'is_current' => false,
                'color' => 'purple',
                'order' => 2,
            ],
            [
                'position' => 'Frontend Developer',
                'company' => 'Startup ABC',
                'description' => 'Built responsive web interfaces and interactive dashboards. Implemented state management solutions and optimized application bundle size by 35%. Participated in code reviews and agile ceremonies.',
                'technologies' => ['React', 'Redux', 'SASS'],
                'start_date' => '2018-01-01',
                'end_date' => '2019-12-31',
                'is_current' => false,
                'color' => 'green',
                'order' => 3,
            ],
            [
                'position' => 'Junior Web Developer',
                'company' => 'Web Studio',
                'description' => 'Started my professional journey building WordPress sites and custom PHP applications. Learned version control with Git and basic DevOps practices. Worked directly with clients to gather requirements.',
                'technologies' => ['PHP', 'WordPress', 'jQuery'],
                'start_date' => '2017-01-01',
                'end_date' => '2017-12-31',
                'is_current' => false,
                'color' => 'orange',
                'order' => 4,
            ],
        ];

        foreach ($experiences as $experience) {
            Experience::create($experience);
        }
    }
}
