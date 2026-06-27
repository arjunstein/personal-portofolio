<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $search = '';
    public ?int $projectToDelete = null;

    public function confirmDelete(int $projectId): void
    {
        $this->projectToDelete = $projectId;
        $this->dispatch('open-modal', name: 'confirm-project-deletion');
    }

    public function deleteConfirmed(): void
    {
        $project = Project::find($this->projectToDelete);

        if (! $project) {
            $this->projectToDelete = null;

            return;
        }

        if ($project->image) {
            \Storage::disk('public')->delete($project->image);
        }

        $project->delete();
        $this->projectToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-project-deletion');
        $this->dispatch('notify', message: 'Project deleted successfully!');
    }

    public function cancelDelete(): void
    {
        $this->projectToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-project-deletion');
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
