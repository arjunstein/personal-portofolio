<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Project $project;
    public string $title = '';
    public string $description = '';
    public $image = null;
    public array $techStack = [];
    public string $techStackInput = '';
    public string $demoUrl = '';
    public string $repoUrl = '';
    public bool $isFeatured = false;
    public int $sortOrder = 0;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required|min:10',
        'image' => 'nullable|image|max:2048',
        'demoUrl' => 'nullable|url',
        'repoUrl' => 'nullable|url',
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->title = $project->title;
        $this->description = $project->description;
        $this->techStack = $project->tech_stack ?? [];
        $this->demoUrl = $project->demo_url ?? '';
        $this->repoUrl = $project->repo_url ?? '';
        $this->isFeatured = $project->is_featured;
        $this->sortOrder = $project->sort_order;
    }

    public function addTechStack()
    {
        if ($this->techStackInput) {
            $this->techStack[] = $this->techStackInput;
            $this->techStackInput = '';
        }
    }

    public function removeTechStack($index)
    {
        unset($this->techStack[$index]);
        $this->techStack = array_values($this->techStack);
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'tech_stack' => $this->techStack,
            'demo_url' => $this->demoUrl ?: null,
            'repo_url' => $this->repoUrl ?: null,
            'sort_order' => $this->sortOrder,
            'is_featured' => $this->isFeatured,
        ];

        if ($this->image) {
            if ($this->project->image) {
                \Storage::disk('public')->delete($this->project->image);
            }
            $data['image'] = $this->image->store('projects', 'public');
        }

        $this->project->update($data);

        $this->dispatch('notify', message: 'Project updated successfully!');
        return $this->redirect('/dashboard/projects', navigate: true);
    }

    public function render()
    {
        return view('livewire.projects.edit')
            ->layout('layouts.dashboard');
    }
}
