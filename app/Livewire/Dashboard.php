<?php

namespace App\Livewire;

use App\Models\Message;
use App\Models\PageView;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Experience;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $chartData = PageView::thisWeek();

        return view('livewire.dashboard', [
            'totalProjects'    => Project::count(),
            'totalSkills'      => Skill::count(),
            'totalExperiences' => Experience::count(),
            'totalMessages'    => Message::count(),
            'unreadMessages'   => Message::unread()->count(),
            'featuredProjects' => Project::where('is_featured', true)->count(),
            'recentMessages'   => Message::latest()->take(5)->get(),
            'totalViews'       => PageView::count(),
            'uniqueVisitors'   => PageView::uniqueVisitors(),
            'chartLabels'      => json_encode(array_column($chartData, 'label')),
            'chartViews'       => json_encode(array_column($chartData, 'views')),
        ])->layout('layouts.dashboard');
    }
}
