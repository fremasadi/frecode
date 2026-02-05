<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'E-Commerce Platform',
                'slug' => 'e-commerce-platform',
                'description' => 'A full-featured e-commerce platform with cart, checkout, and payment integration.',
                'detail' => '<p>This comprehensive e-commerce solution provides everything needed for online retail:</p>
                    <ul>
                        <li>Product catalog with categories and search</li>
                        <li>Shopping cart with real-time updates</li>
                        <li>Secure checkout with multiple payment options</li>
                        <li>Order tracking and management</li>
                        <li>Admin dashboard for inventory management</li>
                    </ul>
                    <p>Built with scalability in mind, handling thousands of concurrent users.</p>',
                'images' => [], // Empty - will be uploaded via admin
                'categories' => ['web'],
                'technologies' => ['Laravel', 'Vue.js', 'MySQL', 'Stripe'],
                'demo_url' => 'https://example.com/ecommerce',
                'github_url' => 'https://github.com/username/ecommerce',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'title' => 'Analytics Dashboard',
                'slug' => 'analytics-dashboard',
                'description' => 'Real-time analytics dashboard with data visualization and reporting features.',
                'detail' => '<p>A powerful analytics platform that transforms raw data into actionable insights:</p>
                    <ul>
                        <li>Real-time data streaming and visualization</li>
                        <li>Custom report builder with drag-and-drop</li>
                        <li>Interactive charts and graphs</li>
                        <li>Export to PDF, Excel, and CSV</li>
                        <li>Role-based access control</li>
                    </ul>',
                'images' => [],
                'categories' => ['web'],
                'technologies' => ['React', 'Node.js', 'Chart.js', 'MongoDB'],
                'demo_url' => 'https://example.com/analytics',
                'github_url' => null,
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'title' => 'Fitness Tracker App',
                'slug' => 'fitness-tracker-app',
                'description' => 'Cross-platform mobile app for tracking workouts, nutrition, and health goals.',
                'detail' => '<p>Your personal fitness companion that helps you achieve your health goals:</p>
                    <ul>
                        <li>Workout logging with 500+ exercises</li>
                        <li>Nutrition tracking with barcode scanner</li>
                        <li>Progress photos and measurements</li>
                        <li>Social features and challenges</li>
                        <li>Integration with wearable devices</li>
                    </ul>',
                'images' => [],
                'categories' => ['mobile'],
                'technologies' => ['Flutter', 'Firebase', 'Provider'],
                'demo_url' => null,
                'github_url' => 'https://github.com/username/fitness-app',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'title' => 'Food Delivery App',
                'slug' => 'food-delivery-app',
                'description' => 'Complete food delivery solution with real-time tracking, payments, and restaurant management.',
                'detail' => '<p>End-to-end food delivery ecosystem with three apps:</p>
                    <ul>
                        <li><strong>Customer App:</strong> Browse menus, order food, track delivery</li>
                        <li><strong>Restaurant App:</strong> Manage orders, update menu, view analytics</li>
                        <li><strong>Driver App:</strong> Accept deliveries, navigate, earn tips</li>
                    </ul>
                    <p>Features real-time GPS tracking and push notifications.</p>',
                'images' => [],
                'categories' => ['web', 'mobile'],
                'technologies' => ['Laravel', 'Flutter', 'PostgreSQL', 'Firebase'],
                'demo_url' => 'https://example.com/fooddelivery',
                'github_url' => 'https://github.com/username/food-delivery',
                'is_featured' => true,
                'order' => 4,
            ],
            [
                'title' => 'RESTful API Service',
                'slug' => 'restful-api-service',
                'description' => 'Scalable REST API with authentication, rate limiting, and comprehensive documentation.',
                'detail' => '<p>Enterprise-grade API service built for reliability and performance:</p>
                    <ul>
                        <li>JWT and OAuth2 authentication</li>
                        <li>Rate limiting and throttling</li>
                        <li>Swagger/OpenAPI documentation</li>
                        <li>Webhook support</li>
                        <li>99.9% uptime SLA</li>
                    </ul>',
                'images' => [],
                'categories' => ['api'],
                'technologies' => ['Node.js', 'Express', 'PostgreSQL', 'Redis'],
                'demo_url' => null,
                'github_url' => 'https://github.com/username/api-service',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'title' => 'Team Collaboration Tool',
                'slug' => 'team-collaboration-tool',
                'description' => 'Real-time collaboration platform with chat, file sharing, and project management.',
                'detail' => '<p>All-in-one workspace for modern teams:</p>
                    <ul>
                        <li>Real-time messaging and video calls</li>
                        <li>File sharing with version control</li>
                        <li>Kanban boards and task management</li>
                        <li>Calendar integration</li>
                        <li>Third-party app integrations</li>
                    </ul>',
                'images' => [],
                'categories' => ['web', 'mobile'],
                'technologies' => ['Next.js', 'Socket.io', 'Flutter', 'AWS S3'],
                'demo_url' => null,
                'github_url' => null,
                'is_featured' => false,
                'order' => 6,
            ],
        ];

        foreach ($projects as $project) {
            Project::create($project);
        }
    }
}
