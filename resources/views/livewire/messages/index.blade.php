<div>
    <h1 class="text-3xl font-bold mb-8">Messages</h1>

    <div class="grid grid-cols-3 gap-6">
        <div class="col-span-1 bg-gray-800 rounded-lg border border-gray-700 p-4 max-h-[70vh] overflow-y-auto">
            @forelse($messages as $message)
            <div wire:click="view({{ $message->id }})" 
                 class="p-4 mb-2 rounded-lg cursor-pointer transition {{ $selectedMessage?->id === $message->id ? 'bg-purple-600' : 'hover:bg-gray-700' }} {{ $message->read_at ? '' : 'border-l-4 border-purple-500' }}">
                <div class="flex justify-between items-start mb-1">
                    <span class="font-semibold text-sm">{{ $message->name }}</span>
                    @if(!$message->read_at)
                    <span class="w-2 h-2 bg-purple-500 rounded-full"></span>
                    @endif
                </div>
                <p class="text-sm text-gray-400 mb-1">{{ $message->subject }}</p>
                <p class="text-xs text-gray-500">{{ $message->created_at->diffForHumans() }}</p>
            </div>
            @empty
            <p class="text-center text-gray-500 py-8">No messages</p>
            @endforelse
        </div>

        <div class="col-span-2">
            @if($selectedMessage)
            <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
                <div class="flex justify-between items-start mb-6">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">{{ $selectedMessage->subject }}</h2>
                        <p class="text-gray-400">From: {{ $selectedMessage->name }} ({{ $selectedMessage->email }})</p>
                        <p class="text-gray-500 text-sm">{{ $selectedMessage->created_at->format('M d, Y H:i') }}</p>
                    </div>
                    <button wire:click="closeDetail" class="text-gray-400 hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="bg-gray-900 rounded-lg p-4 mb-6">
                    <p class="text-gray-200 whitespace-pre-wrap">{{ $selectedMessage->message }}</p>
                </div>

                <div class="flex gap-4">
                    @if($selectedMessage->read_at)
                    <button wire:click="markUnread({{ $selectedMessage->id }})" class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                        Mark as Unread
                    </button>
                    @endif
                    <button wire:click="confirmDelete({{ $selectedMessage->id }})" title="Delete message" aria-label="Delete message" class="p-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
            @else
            <div class="bg-gray-800 rounded-lg border border-gray-700 p-12 text-center text-gray-500">
                <svg class="w-16 h-16 mx-auto mb-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <p>Select a message to view</p>
            </div>
            @endif
        </div>
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>

    <x-modal name="confirm-message-deletion" :show="$messageToDelete !== null">
        <div class="p-6 sm:p-7">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-500/15 text-red-400">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-white">Delete message?</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-400">This action cannot be undone. The selected message will be removed permanently.</p>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" wire:click="cancelDelete" class="px-5 py-2.5 rounded-xl border border-gray-700 bg-gray-800 text-gray-200 hover:bg-gray-700 transition">
                    Cancel
                </button>
                <button type="button" wire:click="deleteConfirmed" class="px-5 py-2.5 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                    Delete
                </button>
            </div>
        </div>
    </x-modal>
</div>
