<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        Project::create([
            'title' => 'E-Commerce Platform',
            'description' => 'A full-featured e-commerce platform with real-time inventory management, payment gateway integration, and admin dashboard built with Laravel and React.',
            'tech_stack' => ['Laravel', 'React', 'Tailwind CSS', 'MySQL', 'Redis'],
            'demo_url' => 'https://demo.example.com/ecommerce',
            'repo_url' => 'https://github.com/arjungunawan/ecommerce',
            'is_featured' => true,
            'sort_order' => 1,
        ]);

        Project::create([
            'title' => 'Task Management App',
            'description' => 'Collaborative task management application with real-time updates, drag-and-drop interface, team workspaces, and analytics dashboard.',
            'tech_stack' => ['Laravel', 'Livewire', 'Alpine.js', 'Tailwind CSS', 'PostgreSQL'],
            'demo_url' => 'https://demo.example.com/tasks',
            'repo_url' => 'https://github.com/arjungunawan/taskmanager',
            'is_featured' => true,
            'sort_order' => 2,
        ]);

        Project::create([
            'title' => 'Real-Time Chat Application',
            'description' => 'Scalable real-time messaging application with WebSocket support, file sharing, group chats, and message search functionality.',
            'tech_stack' => ['Laravel', 'Vue.js', 'WebSockets', 'MongoDB', 'Docker'],
            'demo_url' => 'https://demo.example.com/chat',
            'repo_url' => 'https://github.com/arjungunawan/chat-app',
            'is_featured' => true,
            'sort_order' => 3,
        ]);

        Project::create([
            'title' => 'Analytics Dashboard',
            'description' => 'Interactive analytics dashboard with data visualization, customizable reports, real-time metrics, and role-based access control.',
            'tech_stack' => ['Laravel', 'React', 'D3.js', 'Tailwind CSS', 'Redis'],
            'demo_url' => null,
            'repo_url' => 'https://github.com/arjungunawan/analytics',
            'is_featured' => false,
            'sort_order' => 4,
        ]);

        Project::create([
            'title' => 'API Gateway Service',
            'description' => 'Centralized API gateway with rate limiting, authentication, logging, and request transformation for microservices architecture.',
            'tech_stack' => ['Laravel', 'Docker', 'Kubernetes', 'PostgreSQL', 'Redis'],
            'demo_url' => null,
            'repo_url' => 'https://github.com/arjungunawan/api-gateway',
            'is_featured' => false,
            'sort_order' => 5,
        ]);

        Project::create([
            'title' => 'Portfolio Website',
            'description' => 'Personal portfolio website built with Laravel 12, Livewire 4, and Tailwind CSS 4 featuring SPA navigation and admin dashboard.',
            'tech_stack' => ['Laravel 12', 'Livewire 4', 'Tailwind CSS 4', 'SQLite', 'Docker'],
            'demo_url' => 'https://arjungunawan.dev',
            'repo_url' => 'https://github.com/arjungunawan/portfolio',
            'is_featured' => true,
            'sort_order' => 0,
        ]);
    }
}
