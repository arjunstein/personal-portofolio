<?php

namespace App\Livewire\Messages;

use App\Models\Message;
use Livewire\Component;

class Index extends Component
{
    public ?Message $selectedMessage = null;

    public function view(Message $message)
    {
        $this->selectedMessage = $message;
        if (!$message->read_at) {
            $message->markAsRead();
        }
    }

    public function markUnread(Message $message)
    {
        $message->update(['read_at' => null]);
        $this->selectedMessage = null;
        $this->dispatch('notify', message: 'Message marked as unread.');
    }

    public function delete(Message $message)
    {
        $message->delete();
        $this->selectedMessage = null;
        $this->dispatch('notify', message: 'Message deleted successfully!');
    }

    public function closeDetail()
    {
        $this->selectedMessage = null;
    }

    public function render()
    {
        return view('livewire.messages.index', [
            'messages' => Message::latest()->paginate(10),
        ])->layout('layouts.dashboard');
    }
}
