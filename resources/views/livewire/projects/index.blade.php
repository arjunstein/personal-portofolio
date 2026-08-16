<div>
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold text-white tracking-tight">Projects Management</h1>
            <p class="text-slate-400 text-sm mt-1">Manage, sort, and curate your featured developer showcase projects.</p>
        </div>
        <a href="{{ route('dashboard.projects.create') }}" wire:navigate class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-medium text-xs shadow-lg shadow-purple-600/25 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            <span>Create New Project</span>
        </a>
    </div>

    <div class="mb-6">
        <div class="relative max-w-md">
            <svg class="w-4 h-4 absolute left-4 top-1/2 -translate-y-1/2 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" 
                   wire:model.live="search" 
                   placeholder="Search projects by title or stack..." 
                   class="w-full pl-11 pr-4 py-3 bg-white/[0.03] border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition duration-200">
        </div>
    </div>

    <!-- Desktop table -->
    <div class="hidden md:block glass-card rounded-3xl border border-white/10 overflow-hidden shadow-2xl">
        <table class="w-full text-left">
            <thead>
                <tr class="text-xs font-mono uppercase text-slate-400 border-b border-white/10 bg-white/[0.02]">
                    <th class="py-4 px-6">Project Title</th>
                    <th class="py-4 px-6">Status</th>
                    <th class="py-4 px-6">Tech Stack</th>
                    <th class="py-4 px-6 text-center">Order</th>
                    <th class="py-4 px-6 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 text-sm">
                @forelse($projects as $project)
                <tr class="hover:bg-white/[0.02] transition">
                    <td class="py-4 px-6">
                        <div class="font-semibold text-slate-100 font-display">{{ $project->title }}</div>
                        <div class="text-xs text-slate-400 mt-0.5 max-w-xs truncate">{{ $project->description }}</div>
                    </td>
                    <td class="py-4 px-6">
                        @if($project->is_featured)
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-purple-500/10 text-purple-300 border border-purple-500/20 text-xs font-mono rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-purple-400"></span>
                            <span>Featured</span>
                        </span>
                        @else
                        <span class="px-3 py-1 bg-white/5 text-slate-400 text-xs font-mono rounded-full border border-white/5">Standard</span>
                        @endif
                    </td>
                    <td class="py-4 px-6">
                        @if($project->tech_stack)
                        <div class="flex flex-wrap gap-1 max-w-xs">
                            @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                            <span class="px-2 py-0.5 bg-white/5 border border-white/5 text-slate-300 font-mono text-[11px] rounded-md">{{ $tech }}</span>
                            @endforeach
                            @if(count($project->tech_stack) > 3)
                            <span class="px-2 py-0.5 bg-white/5 border border-white/5 text-slate-400 font-mono text-[11px] rounded-md">+{{ count($project->tech_stack) - 3 }}</span>
                            @endif
                        </div>
                        @endif
                    </td>
                    <td class="py-4 px-6 text-center font-mono text-xs text-slate-400">
                        {{ $project->sort_order }}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <div class="inline-flex items-center gap-2">
                            <a href="{{ route('dashboard.projects.edit', $project) }}" wire:navigate title="Edit project" aria-label="Edit project" class="p-2 rounded-lg bg-indigo-500/10 border border-indigo-500/20 text-indigo-300 hover:bg-indigo-500/20 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                            </a>
                            <button wire:click="confirmDelete({{ $project->id }})" title="Delete project" aria-label="Delete project" class="p-2 rounded-lg bg-red-500/10 border border-red-500/20 text-red-400 hover:bg-red-500/20 transition cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-12 text-center text-slate-500 font-mono text-sm">No projects found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mobile cards -->
    <div class="space-y-4 md:hidden">
        @forelse($projects as $project)
        <div class="glass-card rounded-2xl p-5 space-y-3 border border-white/10">
            <div class="flex justify-between items-start gap-2">
                <div>
                    <div class="font-semibold text-white font-display">{{ $project->title }}</div>
                    <div class="text-xs text-slate-400 mt-1 line-clamp-2">{{ $project->description }}</div>
                </div>
                @if($project->is_featured)
                <span class="shrink-0 px-2.5 py-1 bg-purple-500/15 border border-purple-500/30 text-purple-300 text-xs font-mono rounded-full">Featured</span>
                @endif
            </div>
            @if($project->tech_stack)
            <div class="flex flex-wrap gap-1">
                @foreach(array_slice($project->tech_stack, 0, 3) as $tech)
                <span class="px-2 py-0.5 bg-white/5 text-slate-300 font-mono text-[10px] rounded">{{ $tech }}</span>
                @endforeach
                @if(count($project->tech_stack) > 3)
                <span class="px-2 py-0.5 bg-white/5 text-slate-400 font-mono text-[10px] rounded">+{{ count($project->tech_stack) - 3 }}</span>
                @endif
            </div>
            @endif
            <div class="flex justify-between items-center pt-2 border-t border-white/5">
                <span class="text-xs font-mono text-slate-500">Order: {{ $project->sort_order }}</span>
                <div class="flex gap-2">
                    <a href="{{ route('dashboard.projects.edit', $project) }}" wire:navigate class="p-2 rounded-lg bg-indigo-500/10 text-indigo-300">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>
                    <button wire:click="confirmDelete({{ $project->id }})" class="p-2 rounded-lg bg-red-500/10 text-red-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @empty
        <p class="text-center text-slate-500 py-8 font-mono text-xs">No projects found.</p>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $projects->links() }}
    </div>

    <!-- Deletion Confirmation Modal -->
    <x-modal name="confirm-project-deletion" :show="$projectToDelete !== null">
        <div class="p-6 sm:p-8 bg-[#0d1424] border border-white/10 rounded-3xl">
            <div class="flex items-start gap-4">
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-red-500/15 text-red-400 border border-red-500/30">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h2 class="text-xl font-display font-bold text-white">Delete project permanently?</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-400">This action cannot be undone. The project record and its associated assets will be permanently removed.</p>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <button type="button" wire:click="cancelDelete" class="px-5 py-2.5 rounded-xl border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white transition text-sm font-medium">
                    Cancel
                </button>
                <button type="button" wire:click="deleteConfirmed" class="px-5 py-2.5 rounded-xl bg-red-600 hover:bg-red-500 text-white font-semibold transition text-sm shadow-lg shadow-red-600/20 cursor-pointer">
                    Confirm Delete
                </button>
            </div>
        </div>
    </x-modal>
</div>
