<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run(): void
    {
        Message::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'subject' => 'Project Collaboration',
            'message' => 'Hi, I am interested in collaborating on a web project. Your portfolio looks impressive! Let me know if you are available for freelance work.',
            'read_at' => now(),
        ]);

        Message::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@company.com',
            'subject' => 'Job Opportunity',
            'message' => 'We are looking for a senior Laravel developer. Your experience matches what we need. Would you be interested in discussing a potential role?',
            'read_at' => null,
        ]);

        Message::create([
            'name' => 'Ahmad Fauzi',
            'email' => 'ahmad@startup.com',
            'subject' => 'Tech Consultation',
            'message' => 'We need a tech consultation for our e-commerce platform. Could we schedule a call to discuss our architecture and scaling needs?',
            'read_at' => null,
        ]);

        Message::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi@agency.id',
            'subject' => 'Partnership Proposal',
            'message' => 'We are a digital agency looking for technical partners. Your full-stack expertise would be valuable for our client projects.',
            'read_at' => null,
        ]);

        Message::create([
            'name' => 'Rudi Hartono',
            'email' => 'rudi@example.com',
            'subject' => 'Website Feedback',
            'message' => 'Great portfolio website! Love the SPA navigation and dark theme. I am building something similar - would love to know your tech stack choices.',
            'read_at' => now(),
        ]);
    }
}
