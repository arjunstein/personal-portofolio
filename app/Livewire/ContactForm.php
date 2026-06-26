<?php

namespace App\Livewire;

use App\Models\Message;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class ContactForm extends Component
{
    public string $name = '';
    public string $email = '';
    public string $subject = '';
    public string $message = '';

    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email',
        'subject' => 'required|min:3',
        'message' => 'required|min:10',
    ];

    public function submit()
    {
        $this->validate();

        $key = 'contact-form:' . sha1(strtolower($this->email) . '|' . request()->ip());

        if (RateLimiter::tooManyAttempts($key, 2)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = (int) ceil($seconds / 60);

            $this->addError('rate_limit', "You can only send 2 messages per hour. Try again in {$minutes} minute(s).");

            return;
        }

        Message::create([
            'name' => $this->name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
        ]);

        RateLimiter::hit($key, 3600);

        $this->reset();
        $this->resetErrorBag('rate_limit');

        $this->dispatch('notify', message: 'Message sent successfully! I will get back to you soon.');
    }

    public function render()
    {
        return view('livewire.contact-form');
    }
}
