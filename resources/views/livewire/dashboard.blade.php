<div>
    <h1 class="text-3xl font-bold mb-8">Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Projects</p>
                    <p class="text-3xl font-bold text-white">{{ $totalProjects }}</p>
                </div>
                <div class="bg-purple-600 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Skills</p>
                    <p class="text-3xl font-bold text-white">{{ $totalSkills }}</p>
                </div>
                <div class="bg-indigo-600 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Experiences</p>
                    <p class="text-3xl font-bold text-white">{{ $totalExperiences }}</p>
                </div>
                <div class="bg-pink-600 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Messages</p>
                    <p class="text-3xl font-bold text-white">{{ $totalMessages }}</p>
                    @if($unreadMessages > 0)
                    <p class="text-purple-400 text-sm">{{ $unreadMessages }} unread</p>
                    @endif
                </div>
                <div class="bg-green-600 p-3 rounded-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Section -->
    <div class="grid grid-cols-2 gap-6 mb-8">
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <p class="text-gray-400 text-sm mb-1">Total Page Views</p>
            <p class="text-3xl font-bold text-white">{{ number_format($totalViews) }}</p>
        </div>
        <div class="bg-gray-800 rounded-lg p-6 border border-gray-700">
            <p class="text-gray-400 text-sm mb-1">Unique Visitors</p>
            <p class="text-3xl font-bold text-white">{{ number_format($uniqueVisitors) }}</p>
        </div>
    </div>

    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 mb-8">
        <h2 class="text-xl font-semibold mb-4">Visitors (7 Days)</h2>
        <canvas id="visitorChart" height="80"></canvas>
    </div>

    <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
        <h2 class="text-xl font-semibold mb-4">Recent Messages</h2>
        <!-- Desktop table -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="text-left text-gray-400 border-b border-gray-700">
                        <th class="pb-3">Name</th>
                        <th class="pb-3">Email</th>
                        <th class="pb-3">Subject</th>
                        <th class="pb-3">Date</th>
                        <th class="pb-3">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMessages as $message)
                    <tr class="border-b border-gray-700 hover:bg-gray-700">
                        <td class="py-3">{{ $message->name }}</td>
                        <td class="py-3">{{ $message->email }}</td>
                        <td class="py-3">{{ $message->subject }}</td>
                        <td class="py-3">{{ $message->created_at->diffForHumans() }}</td>
                        <td class="py-3">
                            @if($message->read_at)
                            <span class="text-green-400">Read</span>
                            @else
                            <span class="text-purple-400 font-semibold">Unread</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="py-8 text-center text-gray-500">No messages yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile cards -->
        <div class="space-y-3 md:hidden">
            @forelse($recentMessages as $message)
            <div class="bg-gray-700/50 rounded-lg p-4 space-y-2">
                <div class="flex justify-between items-start">
                    <span class="font-medium text-white">{{ $message->name }}</span>
                    @if($message->read_at)
                    <span class="text-green-400 text-sm">Read</span>
                    @else
                    <span class="text-purple-400 text-sm font-semibold">Unread</span>
                    @endif
                </div>
                <p class="text-sm text-gray-300">{{ $message->subject }}</p>
                <div class="flex justify-between text-xs text-gray-400">
                    <span>{{ $message->email }}</span>
                    <span>{{ $message->created_at->diffForHumans() }}</span>
                </div>
            </div>
            @empty
            <p class="text-center text-gray-500 py-8">No messages yet</p>
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
                    backgroundColor: 'rgba(139, 92, 246, 0.5)',
                    borderColor: 'rgb(139, 92, 246)',
                    borderWidth: 1,
                    borderRadius: 4,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    x: { ticks: { color: '#9ca3af' }, grid: { color: '#374151' } },
                    y: { beginAtZero: true, ticks: { color: '#9ca3af', precision: 0 }, grid: { color: '#374151' } },
                },
            },
        });
    }
</script>
@endscript

