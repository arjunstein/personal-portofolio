<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard', [
            'totalProjects' => Project::count(),
            'totalSkills' => Skill::count(),
            'totalExperiences' => Experience::count(),
            'totalMessages' => Message::count(),
            'unreadMessages' => Message::unread()->count(),
            'featuredProjects' => Project::where('is_featured', true)->count(),
            'recentMessages' => Message::latest()->take(5)->get(),
        ])->layout('layouts.dashboard');
    }
}
