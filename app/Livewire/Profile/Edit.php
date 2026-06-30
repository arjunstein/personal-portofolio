<?php

namespace App\Livewire\Profile;

use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public ?Profile $profile = null;
    public string $name = '';
    public string $tagline = '';
    public string $bio = '';
    public $photo = null;
    public string $email = '';
    public string $phone = '';
    public string $whatsapp = '';
    public string $location = '';
    public string $github = '';
    public string $linkedin = '';
    public string $twitter = '';
    public string $instagram = '';

    protected $rules = [
        'name' => 'required|min:3',
        'tagline' => 'nullable|string',
        'bio' => 'nullable|string',
        'photo' => 'nullable|image|max:2048',
        'email' => 'nullable|email',
        'phone' => 'nullable|string',
        'whatsapp' => 'nullable|string',
        'location' => 'nullable|string',
        'github' => 'nullable|url',
        'linkedin' => 'nullable|url',
        'twitter' => 'nullable|url',
        'instagram' => 'nullable|url',
    ];

    public function mount()
    {
        $this->profile = Profile::first();

        if ($this->profile) {
            $this->name = $this->profile->name ?? '';
            $this->tagline = $this->profile->tagline ?? '';
            $this->bio = $this->profile->bio ?? '';
            $this->email = $this->profile->email ?? '';
            $this->phone = $this->profile->phone ?? '';
            $this->whatsapp = $this->profile->whatsapp ?? '';
            $this->location = $this->profile->location ?? '';
            $this->github = $this->profile->github ?? '';
            $this->linkedin = $this->profile->linkedin ?? '';
            $this->twitter = $this->profile->twitter ?? '';
            $this->instagram = $this->profile->instagram ?? '';
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'tagline' => $this->tagline ?: null,
            'bio' => $this->bio ?: null,
            'email' => $this->email ?: null,
            'phone' => $this->phone ?: null,
            'whatsapp' => $this->whatsapp ?: null,
            'location' => $this->location ?: null,
            'github' => $this->github ?: null,
            'linkedin' => $this->linkedin ?: null,
            'twitter' => $this->twitter ?: null,
            'instagram' => $this->instagram ?: null,
        ];

        if ($this->photo) {
            if ($this->profile?->photo) {
                \Storage::disk('public')->delete($this->profile->photo);
            }
            $data['photo'] = $this->photo->store('profile', 'public');
        }

        if ($this->profile) {
            $this->profile->update($data);
        } else {
            $this->profile = Profile::create($data);
        }

        $this->dispatch('notify', message: 'Profile updated successfully!');
    }

    public function render()
    {
        return view('livewire.profile.edit')
            ->layout('layouts.dashboard');
    }
}
