<?php

namespace Database\Seeders;

use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileSeeder extends Seeder
{
    public function run(): void
    {
        Profile::create([
            'name' => 'Arjun Gunawan',
            'tagline' => 'Full-Stack Developer & UI/UX Enthusiast',
            'bio' => 'I am a passionate full-stack developer with over 5 years of experience building modern web applications. I specialize in Laravel, React, and Tailwind CSS. I love turning complex problems into simple, beautiful, and intuitive solutions.',
            'email' => 'arjun@example.com',
            'phone' => '+62 812-3456-7890',
            'location' => 'Jakarta, Indonesia',
            'github' => 'https://github.com/arjungunawan',
            'linkedin' => 'https://linkedin.com/in/arjungunawan',
            'twitter' => 'https://twitter.com/arjungunawan',
            'instagram' => 'https://instagram.com/arjungunawan',
        ]);
    }
}
