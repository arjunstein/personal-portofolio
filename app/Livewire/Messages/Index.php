<?php

namespace App\Livewire\Messages;

use App\Models\Message;
use Livewire\Component;

class Index extends Component
{
    public ?Message $selectedMessage = null;
    public ?int $messageToDelete = null;

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

    public function confirmDelete(int $messageId): void
    {
        $this->messageToDelete = $messageId;
        $this->dispatch('open-modal', name: 'confirm-message-deletion');
    }

    public function deleteConfirmed(): void
    {
        $message = Message::find($this->messageToDelete);

        if (! $message) {
            $this->messageToDelete = null;

            return;
        }

        $message->delete();
        $this->selectedMessage = null;
        $this->messageToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-message-deletion');
        $this->dispatch('notify', message: 'Message deleted successfully!');
    }

    public function cancelDelete(): void
    {
        $this->messageToDelete = null;
        $this->dispatch('close-modal', name: 'confirm-message-deletion');
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
