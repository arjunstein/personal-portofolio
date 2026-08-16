<div>
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-display font-bold text-white tracking-tight">Dashboard Overview</h1>
            <p class="text-slate-400 text-sm mt-1">Real-time portfolio metrics, visitor analytics, and recent inquiries.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard.projects.create') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-medium text-xs shadow-lg shadow-purple-600/25 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                <span>Add Project</span>
            </a>
        </div>
    </div>

    <!-- Stats Grid (Bento Metrics) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        
        <!-- Total Projects -->
        <div class="glass-card glass-card-hover rounded-2xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Projects</p>
                    <p class="text-3xl font-display font-bold text-white mt-2">{{ $totalProjects }}</p>
                    <span class="inline-flex items-center gap-1 text-[11px] font-mono text-purple-400 mt-2">
                        <span>Showcase items</span>
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-purple-500/15 border border-purple-500/30 flex items-center justify-center text-purple-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Skills -->
        <div class="glass-card glass-card-hover rounded-2xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Skills</p>
                    <p class="text-3xl font-display font-bold text-white mt-2">{{ $totalSkills }}</p>
                    <span class="inline-flex items-center gap-1 text-[11px] font-mono text-indigo-400 mt-2">
                        <span>Categorized</span>
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-indigo-500/15 border border-indigo-500/30 flex items-center justify-center text-indigo-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Experiences -->
        <div class="glass-card glass-card-hover rounded-2xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Experiences</p>
                    <p class="text-3xl font-display font-bold text-white mt-2">{{ $totalExperiences }}</p>
                    <span class="inline-flex items-center gap-1 text-[11px] font-mono text-pink-400 mt-2">
                        <span>Career milestones</span>
                    </span>
                </div>
                <div class="w-12 h-12 rounded-xl bg-pink-500/15 border border-pink-500/30 flex items-center justify-center text-pink-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Messages -->
        <div class="glass-card glass-card-hover rounded-2xl p-6 relative overflow-hidden">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Messages</p>
                    <p class="text-3xl font-display font-bold text-white mt-2">{{ $totalMessages }}</p>
                    @if($unreadMessages > 0)
                        <span class="inline-flex items-center gap-1 text-[11px] font-mono text-emerald-400 mt-2 font-medium">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                            <span>{{ $unreadMessages }} unread</span>
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-[11px] font-mono text-slate-500 mt-2">
                            <span>All read</span>
                        </span>
                    @endif
                </div>
                <div class="w-12 h-12 rounded-xl bg-emerald-500/15 border border-emerald-500/30 flex items-center justify-center text-emerald-400 shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- Analytics Views Summary -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
        <div class="glass-card rounded-2xl p-6 flex items-center justify-between">
            <div>
                <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Page Views</p>
                <p class="text-3xl font-display font-extrabold text-white mt-2">{{ number_format($totalViews) }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                </svg>
            </div>
        </div>

        <div class="glass-card rounded-2xl p-6 flex items-center justify-between">
            <div>
                <p class="text-xs font-mono uppercase tracking-wider text-slate-400">Unique Visitors</p>
                <p class="text-3xl font-display font-extrabold text-white mt-2">{{ number_format($uniqueVisitors) }}</p>
            </div>
            <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
        </div>
    </div>

    <!-- Chart.js Monthly Activity -->
    <div class="glass-card rounded-3xl p-6 sm:p-8 mb-8 border border-white/10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-display font-bold text-white">Visitors Activity This Month</h2>
                <p class="text-xs font-mono text-slate-400 mt-0.5">Daily page view trends</p>
            </div>
        </div>
        <div class="relative w-full overflow-hidden">
            <canvas id="visitorChart" height="90"></canvas>
        </div>
    </div>

    <!-- Recent Messages Table -->
    <div class="glass-card rounded-3xl p-6 sm:p-8 border border-white/10">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-lg font-display font-bold text-white">Recent Messages</h2>
                <p class="text-xs font-mono text-slate-400 mt-0.5">Latest contact submissions from your portfolio</p>
            </div>
            <a href="{{ route('dashboard.messages.index') }}" wire:navigate class="text-xs font-mono text-purple-400 hover:text-purple-300 transition">
                View all →
            </a>
        </div>

        <!-- Desktop Table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs font-mono uppercase text-slate-400 border-b border-white/10">
                        <th class="pb-3 px-3">Sender</th>
                        <th class="pb-3 px-3">Subject</th>
                        <th class="pb-3 px-3">Date</th>
                        <th class="pb-3 px-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 text-sm">
                    @forelse($recentMessages as $message)
                    <tr class="hover:bg-white/[0.02] transition">
                        <td class="py-4 px-3">
                            <div class="font-medium text-slate-200">{{ $message->name }}</div>
                            <div class="text-xs font-mono text-slate-500">{{ $message->email }}</div>
                        </td>
                        <td class="py-4 px-3 text-slate-300">
                            {{ Str::limit($message->subject, 40) }}
                        </td>
                        <td class="py-4 px-3 font-mono text-xs text-slate-400">
                            {{ $message->created_at->diffForHumans() }}
                        </td>
                        <td class="py-4 px-3">
                            @if($message->read_at)
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-[11px] font-mono bg-white/5 text-slate-400 border border-white/10">
                                    Read
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[11px] font-mono bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 font-medium">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                                    <span>New</span>
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-8 text-center text-slate-500 font-mono text-sm">
                            No messages received yet.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards -->
        <div class="space-y-3 md:hidden">
            @forelse($recentMessages as $message)
            <div class="p-4 rounded-2xl bg-white/[0.02] border border-white/5 space-y-2">
                <div class="flex justify-between items-start">
                    <span class="font-medium text-slate-200 text-sm">{{ $message->name }}</span>
                    @if($message->read_at)
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-white/5 text-slate-400">Read</span>
                    @else
                        <span class="text-[10px] font-mono px-2 py-0.5 rounded bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">New</span>
                    @endif
                </div>
                <p class="text-xs text-slate-300">{{ $message->subject }}</p>
                <div class="flex justify-between text-[11px] font-mono text-slate-500 pt-1 border-t border-white/5">
                    <span>{{ $message->email }}</span>
                    <span>{{ $message->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @empty
            <p class="text-center text-slate-500 py-8 font-mono text-xs">No messages yet.</p>
            @endforelse
        </div>
    </div>
</div>

@script
<script>
    const ctx = document.getElementById('visitorChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! $chartLabels !!},
                datasets: [{
                    label: 'Page Views',
                    data: {!! $chartViews !!},
                    backgroundColor: 'rgba(139, 92, 246, 0.4)',
                    hoverBackgroundColor: 'rgba(139, 92, 246, 0.8)',
                    borderColor: 'rgb(139, 92, 246)',
                    borderWidth: 1,
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: { 
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#0d1424',
                        titleColor: '#ffffff',
                        bodyColor: '#cbd5e1',
                        borderColor: 'rgba(255,255,255,0.1)',
                        borderWidth: 1,
                        padding: 10,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: { 
                        ticks: { color: '#64748b', font: { family: 'JetBrains Mono', size: 11 } }, 
                        grid: { color: 'rgba(255, 255, 255, 0.04)' } 
                    },
                    y: { 
                        beginAtZero: true, 
                        ticks: { color: '#64748b', precision: 0, font: { family: 'JetBrains Mono', size: 11 } }, 
                        grid: { color: 'rgba(255, 255, 255, 0.04)' } 
                    },
                },
            },
        });
    }
</script>
@endscript
