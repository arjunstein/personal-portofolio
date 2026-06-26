<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    public function run(): void
    {
        Experience::create([
            'company' => 'Tech Corp Indonesia',
            'position' => 'Senior Full-Stack Developer',
            'start_date' => '2022-01-01',
            'end_date' => null,
            'description' => 'Lead development of microservices architecture using Laravel and React. Improved deployment pipeline reducing release time by 60%. Mentored junior developers and conducted code reviews.',
            'sort_order' => 1,
        ]);

        Experience::create([
            'company' => 'StartupXYZ',
            'position' => 'Full-Stack Developer',
            'start_date' => '2020-03-01',
            'end_date' => '2021-12-31',
            'description' => 'Built and maintained multiple client-facing web applications. Implemented real-time features using Laravel WebSockets and Livewire. Reduced page load times by 40%.',
            'sort_order' => 2,
        ]);

        Experience::create([
            'company' => 'WebDigital Agency',
            'position' => 'Junior Developer',
            'start_date' => '2018-06-01',
            'end_date' => '2020-02-29',
            'description' => 'Developed responsive websites and web applications. Collaborated with design team to implement pixel-perfect UIs. Introduced automated testing practices.',
            'sort_order' => 3,
        ]);

        Experience::create([
            'company' => 'Freelance',
            'position' => 'Web Developer',
            'start_date' => '2017-01-01',
            'end_date' => '2018-05-31',
            'description' => 'Built custom websites and e-commerce solutions for small businesses. Managed client relationships and project timelines independently.',
            'sort_order' => 4,
        ]);
    }
}
