<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';

    public function delete(Project $project)
    {
        if ($project->image) {
            \Storage::disk('public')->delete($project->image);
        }
        $project->delete();
        $this->dispatch('notify', message: 'Project deleted successfully!');
    }

    public function render()
    {
        $projects = Project::query()
            ->when($this->search, fn($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->orderBy('sort_order')
            ->paginate(10);

        return view('livewire.projects.index', ['projects' => $projects])
            ->layout('layouts.dashboard');
    }
}
