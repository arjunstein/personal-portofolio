<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Portfolio Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="bg-[#080c14] text-slate-200 antialiased font-sans selection:bg-purple-500/30 selection:text-white" x-data="{ sidebarOpen: false }">
    <!-- Mobile backdrop -->
    <div x-show="sidebarOpen" 
         x-transition.opacity.duration.300ms 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/80 backdrop-blur-md z-40 md:hidden"></div>

    <div class="flex h-screen overflow-hidden bg-[#080c14]">
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" 
               class="fixed inset-y-0 left-0 md:relative md:inset-auto z-50 w-72 h-screen md:h-auto bg-[#0d1424]/90 backdrop-blur-xl border-r border-white/10 flex flex-col transition-transform duration-300 md:translate-x-0 shadow-2xl">
            
            <!-- Brand / Header -->
            <div class="p-6 border-b border-white/10 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-purple-600 to-indigo-600 p-[2px] shadow-lg shadow-purple-600/30">
                        <div class="w-full h-full bg-[#080c14] rounded-[10px] flex items-center justify-center font-display font-bold text-white text-base">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                    <div>
                        <h1 class="text-base font-display font-bold text-white truncate max-w-[140px]">
                            {{ auth()->user()->name }}
                        </h1>
                        <p class="text-xs font-mono text-purple-400">Admin Console</p>
                    </div>
                </div>

                <button @click="sidebarOpen = false" class="md:hidden p-1.5 rounded-lg bg-white/5 text-slate-400 hover:text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            
            <!-- Navigation Links -->
            <nav class="flex-1 overflow-y-auto p-4 space-y-1.5">
                <a href="{{ route('dashboard.index') }}" wire:navigate 
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.index') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.index') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    <span>Dashboard</span>
                </a>
                
                <a href="{{ route('dashboard.projects.index') }}" wire:navigate 
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.projects.*') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.projects.*') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                    </svg>
                    <span>Projects</span>
                </a>
                
                <a href="{{ route('dashboard.skills.index') }}" wire:navigate 
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.skills.*') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.skills.*') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span>Skills</span>
                </a>
                
                <a href="{{ route('dashboard.experiences.index') }}" wire:navigate 
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.experiences.*') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.experiences.*') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Experience</span>
                </a>
                
                <a href="{{ route('dashboard.messages.index') }}" wire:navigate 
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.messages.*') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.messages.*') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    <span>Messages</span>
                </a>
                
                <a href="{{ route('dashboard.profile.edit') }}" wire:navigate
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.profile.*') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.profile.*') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span>Profile</span>
                </a>

                <a href="{{ route('dashboard.account.settings') }}" wire:navigate
                   class="flex items-center gap-3.5 px-4 py-3 rounded-xl transition-all duration-200 text-sm font-medium {{ request()->routeIs('dashboard.account.*') ? 'bg-purple-600/20 text-purple-300 border border-purple-500/30 shadow-lg shadow-purple-600/10' : 'text-slate-400 hover:text-slate-100 hover:bg-white/5' }}">
                    <svg class="w-5 h-5 {{ request()->routeIs('dashboard.account.*') ? 'text-purple-400' : 'text-slate-500' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    <span>Account</span>
                </a>
            </nav>
            
            <!-- Bottom Actions -->
            <div class="shrink-0 p-4 border-t border-white/10 space-y-1.5">
                <button type="button" x-data x-on:click="$dispatch('open-modal', 'confirm-logout')" class="w-full flex items-center gap-3.5 px-4 py-3 rounded-xl hover:bg-red-500/10 text-slate-400 hover:text-red-400 transition text-sm font-medium text-left cursor-pointer">
                    <svg class="w-5 h-5 text-slate-500 hover:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                    <span>Logout</span>
                </button>
            </div>
        </aside>

        <!-- Logout Confirmation Modal -->
        <x-modal name="confirm-logout">
            <div class="p-6 sm:p-8 bg-[#0d1424] border border-white/10 rounded-3xl">
                <div class="flex items-start gap-4">
                    <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-2xl bg-amber-500/15 text-amber-400 border border-amber-500/30">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-xl font-display font-bold text-white">Log out of dashboard?</h2>
                        <p class="mt-2 text-sm leading-relaxed text-slate-400">You will be securely signed out and redirected to the main portfolio homepage.</p>
                    </div>
                </div>

                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" x-on:click="$dispatch('close-modal', 'confirm-logout')" class="px-5 py-2.5 rounded-xl border border-white/10 bg-white/5 text-slate-300 hover:bg-white/10 hover:text-white transition text-sm font-medium">
                        Cancel
                    </button>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-semibold transition text-sm shadow-lg shadow-amber-500/20 cursor-pointer">
                            Confirm Logout
                        </button>
                    </form>
                </div>
            </div>
        </x-modal>

        <!-- Main Content Area -->
        <main class="flex-1 overflow-y-auto relative">
            <!-- Top bar -->
            <div class="sticky top-0 z-30 bg-[#080c14]/80 backdrop-blur-xl border-b border-white/10 px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 rounded-xl bg-white/5 border border-white/10 text-slate-300 hover:text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                    <span class="text-sm font-mono text-slate-400">
                        {{ auth()->user()->email }}
                    </span>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('home') }}" target="_blank" class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 hover:border-purple-500/40 text-xs font-mono text-slate-300 hover:text-white transition">
                        <span>Live Site</span>
                        <svg class="w-3 h-3 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Page Slot -->
            <div class="p-6 md:p-10 max-w-7xl mx-auto">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Notification Toast -->
    <div x-data="{ 
        show: false, 
        message: '', 
        init() {
            window.addEventListener('notify', e => {
                this.message = e.detail.message;
                this.show = true;
                setTimeout(() => this.show = false, 3500);
            });
        }
    }" x-show="show" 
       x-transition:enter="transition ease-out duration-300 transform"
       x-transition:enter-start="opacity-0 translate-y-4"
       x-transition:enter-end="opacity-100 translate-y-0"
       x-transition:leave="transition ease-in duration-200 transform"
       x-transition:leave-start="opacity-100 translate-y-0"
       x-transition:leave-end="opacity-0 translate-y-4"
       class="fixed bottom-6 right-6 glass-panel border border-purple-500/30 text-white px-6 py-4 rounded-2xl shadow-2xl z-50 flex items-center gap-3">
        <div class="w-7 h-7 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <p class="text-sm font-medium text-slate-200" x-text="message"></p>
    </div>

    @livewireScripts
</body>
</html>
