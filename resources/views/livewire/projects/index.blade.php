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

    <div class="bg-gray-800 rounded-lg border border-gray-700 overflow-hidden">
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
                            <a href="{{ route('dashboard.projects.edit', $project) }}" wire:navigate class="px-3 py-1 bg-indigo-600 text-white text-sm rounded hover:bg-indigo-700">
                                Edit
                            </a>
                            <button wire:click="delete({{ $project->id }})" wire:confirm="Are you sure?" class="px-3 py-1 bg-red-600 text-white text-sm rounded hover:bg-red-700">
                                Delete
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

    <div class="mt-6">
        {{ $projects->links() }}
    </div>
</div>
