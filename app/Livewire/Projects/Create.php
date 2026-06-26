<?php

namespace App\Livewire\Projects;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

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

        $imagePath = null;
        if ($this->image) {
            $imagePath = $this->image->store('projects', 'public');
        }

        Project::create([
            'title' => $this->title,
            'slug' => \Illuminate\Support\Str::slug($this->title),
            'description' => $this->description,
            'image' => $imagePath,
            'tech_stack' => $this->techStack,
            'demo_url' => $this->demoUrl ?: null,
            'repo_url' => $this->repoUrl ?: null,
            'sort_order' => $this->sortOrder,
            'is_featured' => $this->isFeatured,
        ]);

        $this->dispatch('notify', message: 'Project created successfully!');
        return $this->redirect('/dashboard/projects', navigate: true);
    }

    public function render()
    {
        return view('livewire.projects.create')
            ->layout('layouts.dashboard');
    }
}
