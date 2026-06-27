<?php

namespace App\Livewire\Skills;

use App\Models\Skill;
use Livewire\Component;

class Index extends Component
{
    public bool $showForm = false;
    public ?Skill $editingSkill = null;
    public ?int $skillToDelete = null;
    public string $name = '';
    public int $level = 50;
    public string $category = '';
    public string $icon = '';

    protected $rules = [
        'name' => 'required|min:2',
        'level' => 'required|integer|min:1|max:100',
        'category' => 'nullable|string',
        'icon' => 'nullable|string',
    ];

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
        $this->resetInput();
    }

    public function edit(Skill $skill)
    {
        $this->editingSkill = $skill;
        $this->name = $skill->name;
        $this->level = $skill->level;
        $this->category = $skill->category ?? '';
        $this->icon = $skill->icon ?? '';
        $this->showForm = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->editingSkill) {
            $this->editingSkill->update([
                'name' => $this->name,
                'level' => $this->level,
                'category' => $this->category ?: null,
                'icon' => $this->icon ?: null,
            ]);
            $this->dispatch('notify', message: 'Skill updated successfully!');
        } else {
            Skill::create([
                'name' => $this->name,
                'level' => $this->level,
                'category' => $this->category ?: null,
                'icon' => $this->icon ?: null,
                'sort_order' => Skill::max('sort_order') + 1,
            ]);
            $this->dispatch('notify', message: 'Skill created successfully!');
        }

        $this->showForm = false;
        $this->resetInput();
    }

    public function confirmDelete(int $skillId): void
    {
        $this->skillToDelete = $skillId;
        $this->dispatch('open-modal', name: 'confirm-skill-deletion');
    }

    public function deleteConfirmed(): void
    {
        $skill = Skill::find($this->skillToDelete);

        if (! $skill) {
            $this->skillToDelete = null;

            return;
        }

        $skill->delete();
        $this->skillToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-skill-deletion');
        $this->dispatch('notify', message: 'Skill deleted successfully!');
    }

    public function cancelDelete(): void
    {
        $this->skillToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-skill-deletion');
    }

    public function moveUp(Skill $skill)
    {
        $prev = Skill::where('sort_order', '<', $skill->sort_order)
            ->orderBy('sort_order', 'desc')->first();
        if ($prev) {
            $temp = $skill->sort_order;
            $skill->update(['sort_order' => $prev->sort_order]);
            $prev->update(['sort_order' => $temp]);
        }
    }

    public function moveDown(Skill $skill)
    {
        $next = Skill::where('sort_order', '>', $skill->sort_order)
            ->orderBy('sort_order')->first();
        if ($next) {
            $temp = $skill->sort_order;
            $skill->update(['sort_order' => $next->sort_order]);
            $next->update(['sort_order' => $temp]);
        }
    }

    public function resetInput()
    {
        $this->editingSkill = null;
        $this->name = '';
        $this->level = 50;
        $this->category = '';
        $this->icon = '';
    }

    public function render()
    {
        $categories = Skill::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        $skills = Skill::orderBy('sort_order')->get()
            ->groupBy(fn($s) => $s->category ?? 'Uncategorized');

        return view('livewire.skills.index', [
            'skillGroups' => $skills,
            'categories' => $categories,
        ])->layout('layouts.dashboard');
    }
}
