<div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Skills</h1>
        <button wire:click="toggleForm" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            {{ $showForm ? 'Cancel' : 'Add New Skill' }}
        </button>
    </div>

    @if($showForm)
    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">{{ $editingSkill ? 'Edit Skill' : 'New Skill' }}</h2>
        <form wire:submit="save" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                    <input type="text" wire:model="name" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                    <input type="text" wire:model="category" placeholder="e.g. Frontend, Backend, DevOps" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Level ({{ $level }}%)</label>
                <input type="range" wire:model.live="level" min="1" max="100" class="w-full h-2 bg-gray-700 rounded-lg appearance-none cursor-pointer">
            </div>

            <div class="flex gap-4">
                <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                    {{ $editingSkill ? 'Update' : 'Save' }}
                </button>
                <button type="button" wire:click="toggleForm" class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                    Cancel
                </button>
            </div>
        </form>
    </div>
    @endif

    <div class="space-y-6">
        @foreach($skillGroups as $category => $skills)
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">{{ $category }}</h2>
            <div class="space-y-4">
                @foreach($skills as $skill)
                <div class="flex items-center gap-4">
                    <div class="flex-1">
                        <div class="flex justify-between mb-2">
                            <span class="font-medium">{{ $skill->name }}</span>
                            <span class="text-gray-400">{{ $skill->level }}%</span>
                        </div>
                        <div class="w-full bg-gray-700 rounded-full h-2">
                            <div class="bg-gradient-to-r from-purple-600 to-indigo-600 h-2 rounded-full transition-all" style="width: {{ $skill->level }}%"></div>
                        </div>
                    </div>
                    <div class="flex gap-2">
                        <button wire:click="moveUp({{ $skill->id }})" class="p-2 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                            </svg>
                        </button>
                        <button wire:click="moveDown({{ $skill->id }})" class="p-2 bg-gray-700 text-gray-300 rounded hover:bg-gray-600">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <button wire:click="edit({{ $skill->id }})" class="p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <button wire:click="confirmDelete({{ $skill->id }})" title="Delete skill" aria-label="Delete skill" class="p-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    <x-modal name="confirm-skill-deletion" :show="$skillToDelete !== null">
        <div class="p-6 sm:p-7">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-500/15 text-red-400">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-white">Delete skill?</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-400">This action cannot be undone. The skill entry will be removed permanently.</p>
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
