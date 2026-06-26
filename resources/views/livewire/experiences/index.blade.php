<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Work Experience</h1>
        <button wire:click="toggleForm" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            {{ $showForm ? 'Cancel' : 'Add Experience' }}
        </button>
    </div>

    @if($showForm)
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">{{ $editingExperience ? 'Edit Experience' : 'New Experience' }}</h2>
        <form wire:submit="save" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Company</label>
                    <input type="text" wire:model="company" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('company') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Position</label>
                    <input type="text" wire:model="position" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('position') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Start Date</label>
                    <input type="date" wire:model="startDate" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('startDate') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">End Date (leave empty if current)</label>
                    <input type="date" wire:model="endDate" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('endDate') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea wire:model="description" rows="4" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    {{ $editingExperience ? 'Update' : 'Save' }}
                </button>
                <button type="button" wire:click="toggleForm" class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="space-y-6">
        @forelse($experiences as $experience)
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 relative">
            <div class="absolute left-0 top-0 bottom-0 w-1 bg-gradient-to-b from-purple-600 to-indigo-600 rounded-l-lg"></div>
            <div class="ml-6">
                <div class="flex justify-between items-start mb-2">
                    <div>
                        <h3 class="text-xl font-semibold">{{ $experience->position }}</h3>
                        <p class="text-purple-400">{{ $experience->company }}</p>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="edit({{ $experience->id }})" class="p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <button wire:click="delete({{ $experience->id }})" wire:confirm="Are you sure?" class="p-2 bg-red-600 text-white rounded hover:bg-red-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                <p class="text-gray-400 text-sm mb-3">
                    {{ $experience->start_date->format('M Y') }} - 
                    {{ $experience->end_date ? $experience->end_date->format('M Y') : 'Present' }}
                </p>
                @if($experience->description)
                <p class="text-gray-300">{{ $experience->description }}</p>
                @endif
            </div>
        </div>
        @empty
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-8 text-center text-gray-500">
            No experiences yet
        </div>
        @endforelse
    </div>
</div>
