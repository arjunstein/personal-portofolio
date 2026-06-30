<div>
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold">Projects</h1>
        <a href="{{ route('dashboard.projects.create') }}" wire:navigate class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            Create New Project
        </a>
    </div>

    <div class="mb-6">
        <input type="text" wire:model.live="search" placeholder="Search projects..." class="w-full max-w-md px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
    </div>

    <!-- Desktop table -->
    <div class="hidden md:block bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-900">
                <tr class="text-left text-gray-400">
                    <th class="p-4">Title</th>
                    <th class="p-4">Featured</th>
                    <th class="p-4">Tech Stack</th>
                    <th class="p-4">Sort Order</th>
                    <th class="p-4">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr class="border-t border-gray-700 hover:bg-gray-700">
                    <td class="p-4">
                        <div class="font-semibold">{{ $project->title }}</div>
                        <div class="text-sm text-gray-400">{{ Str::limit($project->description, 50) }}</div>
                    </td>
                    <td class="p-4">
                        @if($project->is_featured)
                        <span class="px-2 py-1 bg-purple-600 text-white text-xs rounded">Featured</span>
                        @endif
                    </td>
                    <td class="p-4">
                        @if($project->tech_stack)
                        <div class="flex flex-wrap gap-1">
                            @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                            <span class="px-2 py-1 bg-gray-700 text-xs rounded">{{ $tech }}</span>
                            @endforeach
                            @if(count($project->tech_stack) > 3)
                            <span class="px-2 py-1 bg-gray-700 text-xs rounded">+{{ count($project->tech_stack) - 3 }}</span>
                            @endif
                        </div>
                        @endif
                    </td>
                    <td class="p-4">{{ $project->sort_order }}</td>
                    <td class="p-4">
                        <div class="flex gap-2">
                            <a href="{{ route('dashboard.projects.edit', $project) }}" wire:navigate title="Edit project" aria-label="Edit project" class="p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <button wire:click="confirmDelete({{ $project->id }})" title="Delete project" aria-label="Delete project" class="p-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="p-8 text-center text-gray-500">No projects found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile cards -->
    <div class="space-y-3 md:hidden">
        @forelse($projects as $project)
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-4 space-y-3">
            <div class="flex justify-between items-start gap-2">
                <div>
                    <div class="font-semibold text-white">{{ $project->title }}</div>
                    <div class="text-sm text-gray-400 mt-0.5">{{ Str::limit($project->description, 60) }}</div>
                </div>
                @if($project->is_featured)
                <span class="shrink-0 px-2 py-1 bg-purple-600 text-white text-xs rounded">Featured</span>
                @endif
            </div>
            @if($project->tech_stack)
            <div class="flex flex-wrap gap-1">
                @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                <span class="px-2 py-1 bg-gray-700 text-xs rounded">{{ $tech }}</span>
                @endforeach
                @if(count($project->tech_stack) > 3)
                <span class="px-2 py-1 bg-gray-700 text-xs rounded">+{{ count($project->tech_stack) - 3 }}</span>
                @endif
            </div>
            @endif
            <div class="flex justify-between items-center">
                <span class="text-xs text-gray-500">Order: {{ $project->sort_order }}</span>
                <div class="flex gap-2">
                    <a href="{{ route('dashboard.projects.edit', $project) }}" wire:navigate title="Edit project" aria-label="Edit project" class="p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <button wire:click="confirmDelete({{ $project->id }})" title="Delete project" aria-label="Delete project" class="p-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-gray-500 py-8">No projects found</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

    <x-modal name="confirm-project-deletion" :show="$projectToDelete !== null">
        <div class="p-6 sm:p-7">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-500/15 text-red-400">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-semibold text-white">Delete project?</h2>
                    <p class="mt-2 text-sm leading-6 text-gray-400">This action cannot be undone. The project and its image will be removed permanently.</p>
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
