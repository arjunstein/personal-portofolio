<?php

namespace App\Livewire\Experiences;

use App\Models\Experience;
use Livewire\Component;

class Index extends Component
{
    public bool $showForm = false;
    public ?Experience $editingExperience = null;
    public ?int $experienceToDelete = null;
    public string $company = '';
    public string $position = '';
    public string $startDate = '';
    public string $endDate = '';
    public string $description = '';

    protected $rules = [
        'company' => 'required|min:2',
        'position' => 'required|min:2',
        'startDate' => 'required|date',
        'endDate' => 'nullable|date|after:startDate',
        'description' => 'nullable|string',
    ];

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        $this->resetInput();
    }

    public function edit(Experience $experience)
    {
        $this->editingExperience = $experience;
        $this->company = $experience->company;
        $this->position = $experience->position;
        $this->startDate = $experience->start_date->format('Y-m-d');
        $this->endDate = $experience->end_date?->format('Y-m-d') ?? '';
        $this->description = $experience->description ?? '';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'company' => $this->company,
            'position' => $this->position,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate ?: null,
            'description' => $this->description ?: null,
        ];

        if ($this->editingExperience) {
            $this->editingExperience->update($data);
            $this->dispatch('notify', message: 'Experience updated successfully!');
        } else {
            $data['sort_order'] = Experience::max('sort_order') + 1;
            Experience::create($data);
            $this->dispatch('notify', message: 'Experience created successfully!');
        }

        $this->showForm = false;
        $this->resetInput();
    }

    public function confirmDelete(int $experienceId): void
    {
        $this->experienceToDelete = $experienceId;
        $this->dispatch('open-modal', name: 'confirm-experience-deletion');
    }

    public function deleteConfirmed(): void
    {
        $experience = Experience::find($this->experienceToDelete);

        if (! $experience) {
            $this->experienceToDelete = null;

            return;
        }

        $experience->delete();
        $this->experienceToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-experience-deletion');
        $this->dispatch('notify', message: 'Experience deleted successfully!');
    }

    public function cancelDelete(): void
    {
        $this->experienceToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-experience-deletion');
    }

    public function resetInput()
    {
        $this->editingExperience = null;
        $this->company = '';
        $this->position = '';
        $this->startDate = '';
        $this->endDate = '';
        $this->description = '';
    }

    public function render()
    {
        return view('livewire.experiences.index', [
            'experiences' => Experience::orderBy('sort_order')->get(),
        ])->layout('layouts.dashboard');
    }
}
