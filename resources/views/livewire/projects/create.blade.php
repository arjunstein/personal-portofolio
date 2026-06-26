<div>
    <div class="mb-8">
        <a href="{{ route('dashboard.projects.index') }}" wire:navigate class="text-purple-400 hover:text-purple-300">← Back to Projects</a>
        <h1 class="text-3xl font-bold mt-4">Create New Project</h1>
    </div>

    <form wire:submit="save" class="max-w-3xl space-y-6">
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Title</label>
                <input type="text" wire:model="title" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                @error('title') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Description</label>
                <textarea wire:model="description" rows="4" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"></textarea>
                @error('description') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Image</label>
                <input type="file" wire:model="image" accept="image/*" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100">
                @error('image') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                @if($image)
                <img src="{{ $image->temporaryUrl() }}" class="mt-4 h-40 rounded-lg object-cover">
                @endif
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tech Stack</label>
                <div class="flex gap-2 mb-2">
                    <input type="text" wire:model="techStackInput" wire:keydown.enter.prevent="addTechStack" placeholder="Add technology..." class="flex-1 px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100">
                    <button type="button" wire:click="addTechStack" class="px-4 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700">Add</button>
                </div>
                <div class="flex flex-wrap gap-2">
                    @foreach($techStack as $index => $tech)
                    <span class="px-3 py-1 bg-gray-700 rounded-full text-sm flex items-center gap-2">
                        {{ $tech }}
                        <button type="button" wire:click="removeTechStack({{ $index }})" class="text-red-400 hover:text-red-300">×</button>
                    </span>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Demo URL</label>
                    <input type="url" wire:model="demoUrl" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('demoUrl') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Repository URL</label>
                    <input type="url" wire:model="repoUrl" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('repoUrl') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Sort Order</label>
                    <input type="number" wire:model="sortOrder" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                </div>

                <div class="flex items-center pt-8">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" wire:model="isFeatured" class="w-5 h-5 bg-gray-900 border-gray-700 rounded text-purple-600 focus:ring-purple-500">
                        <span class="text-gray-300">Featured Project</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex gap-4">
            <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                Create Project
            </button>
            <a href="{{ route('dashboard.projects.index') }}" wire:navigate class="px-6 py-3 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                Cancel
            </a>
        </div>
    </form>
</div>
