@php
    $profile = \App\Models\Profile::first();
    $skills = \App\Models\Skill::orderBy('sort_order')->get()->groupBy('category');
    $experiences = \App\Models\Experience::orderBy('sort_order')->get();
    $projects = \App\Models\Project::where('is_featured', true)->orderBy('sort_order')->get();
    $totalProjects = \App\Models\Project::count();
    $totalSkills = \App\Models\Skill::count();
@endphp
<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Portfolio' }} — {{ $profile->tagline ?? 'Full-Stack Developer' }}</title>
    <meta name="description" content="{{ Str::limit($profile->bio ?? 'Personal portfolio and showcase of full-stack web development projects and skills.', 160) }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-[#080c14] text-slate-200 antialiased selection:bg-purple-500/30 selection:text-white relative min-h-screen" 
      x-data="portfolio()" 
      x-init="init()" 
      x-bind:class="{ 'overflow-hidden': mobileMenuOpen }">

    <!-- Ambient Lighting Background -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 left-1/2 -translate-x-1/2 w-[800px] h-[500px] bg-gradient-to-b from-purple-600/15 via-indigo-600/10 to-transparent blur-[120px] rounded-full"></div>
        <div class="absolute top-[35%] -left-40 w-[600px] h-[600px] bg-indigo-600/10 blur-[140px] rounded-full"></div>
        <div class="absolute top-[65%] -right-40 w-[600px] h-[600px] bg-purple-600/10 blur-[140px] rounded-full"></div>
        <div class="absolute inset-0 bg-grid-pattern opacity-40"></div>
    </div>

    <!-- Floating Navigation Bar -->
    <header class="fixed top-4 left-0 right-0 z-50 px-4 sm:px-6">
        <nav class="max-w-5xl mx-auto glass-panel rounded-full px-5 py-3 flex items-center justify-between shadow-2xl shadow-black/50 border border-white/10 backdrop-blur-xl">
            <!-- Brand / Logo -->
            <a href="#hero" @click.prevent="scrollTo('hero')" class="flex items-center gap-3 group">
                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-purple-600 via-indigo-600 to-cyan-400 p-[2px] shadow-lg shadow-purple-500/20 group-hover:scale-105 transition-transform duration-300">
                    @if($profile?->photo)
                        <img src="{{ Storage::url($profile->photo) }}" alt="{{ $profile->name }}" class="w-full h-full object-cover rounded-full">
                    @else
                        <div class="w-full h-full bg-[#0d1322] rounded-full flex items-center justify-center font-display font-bold text-white text-base">
                            {{ substr($profile->name ?? 'A', 0, 1) }}
                        </div>
                    @endif
                </div>
                <span class="font-display font-bold text-base sm:text-lg tracking-tight text-white group-hover:text-purple-300 transition">
                    {{ $profile->name ?? 'Portfolio' }}
                </span>
            </a>

            <!-- Desktop Nav Links -->
            <div class="hidden md:flex items-center gap-1 bg-white/5 border border-white/5 rounded-full p-1">
                <a href="#about" @click.prevent="scrollTo('about')" 
                   :class="activeSection === 'about' ? 'bg-purple-600/30 text-white font-medium shadow-sm border border-purple-500/30' : 'text-slate-300 hover:text-white hover:bg-white/5'" 
                   class="px-4 py-1.5 rounded-full text-sm transition-all duration-200">About</a>
                
                <a href="#skills" @click.prevent="scrollTo('skills')" 
                   :class="activeSection === 'skills' ? 'bg-purple-600/30 text-white font-medium shadow-sm border border-purple-500/30' : 'text-slate-300 hover:text-white hover:bg-white/5'" 
                   class="px-4 py-1.5 rounded-full text-sm transition-all duration-200">Skills</a>
                
                <a href="#experiences" @click.prevent="scrollTo('experiences')" 
                   :class="activeSection === 'experiences' ? 'bg-purple-600/30 text-white font-medium shadow-sm border border-purple-500/30' : 'text-slate-300 hover:text-white hover:bg-white/5'" 
                   class="px-4 py-1.5 rounded-full text-sm transition-all duration-200">Experience</a>
                
                <a href="#projects" @click.prevent="scrollTo('projects')" 
                   :class="activeSection === 'projects' ? 'bg-purple-600/30 text-white font-medium shadow-sm border border-purple-500/30' : 'text-slate-300 hover:text-white hover:bg-white/5'" 
                   class="px-4 py-1.5 rounded-full text-sm transition-all duration-200">Projects</a>
                
                <a href="#contact" @click.prevent="scrollTo('contact')" 
                   :class="activeSection === 'contact' ? 'bg-purple-600/30 text-white font-medium shadow-sm border border-purple-500/30' : 'text-slate-300 hover:text-white hover:bg-white/5'" 
                   class="px-4 py-1.5 rounded-full text-sm transition-all duration-200">Contact</a>
            </div>

            <!-- Right Action & Mobile Toggle -->
            <div class="flex items-center gap-3">
                <a href="#contact" @click.prevent="scrollTo('contact')" class="hidden sm:inline-flex items-center gap-2 px-4 py-2 rounded-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white text-xs font-semibold uppercase tracking-wider shadow-lg shadow-purple-600/25 transition-all hover:scale-105 active:scale-95">
                    <span>Let's Talk</span>
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </a>

                <!-- Mobile menu button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" aria-label="Toggle navigation menu" class="md:hidden p-2 rounded-full bg-white/5 border border-white/10 text-slate-300 hover:text-white hover:bg-white/10 transition">
                    <svg x-show="!mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </nav>
    </header>

    <!-- Mobile Drawer Overlay -->
    <div x-show="mobileMenuOpen" 
         x-transition.opacity.duration.300ms 
         class="fixed inset-0 bg-black/80 backdrop-blur-md z-40 md:hidden" 
         @click="mobileMenuOpen = false"></div>

    <!-- Mobile Navigation Drawer -->
    <nav x-show="mobileMenuOpen" 
         x-transition:enter="transition ease-out duration-300 transform" 
         x-transition:enter-start="translate-x-full" 
         x-transition:enter-end="translate-x-0" 
         x-transition:leave="transition ease-in duration-200 transform" 
         x-transition:leave-start="translate-x-0" 
         x-transition:leave-end="translate-x-full" 
         class="fixed top-0 right-0 h-full w-80 max-w-[85vw] bg-[#0d1424] border-l border-white/10 z-50 md:hidden flex flex-col p-6 shadow-2xl justify-between">
        <div>
            <div class="flex items-center justify-between pb-6 border-b border-white/10">
                <span class="font-display font-bold text-lg text-white">Menu</span>
                <button @click="mobileMenuOpen = false" class="p-2 rounded-full bg-white/5 text-slate-400 hover:text-white transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="flex flex-col gap-2 mt-6">
                <a href="#about" @click.prevent="scrollTo('about'); mobileMenuOpen = false" 
                   :class="activeSection === 'about' ? 'bg-purple-600/20 text-purple-300 border-purple-500/30' : 'text-slate-300 hover:bg-white/5 border-transparent'" 
                   class="px-4 py-3 rounded-xl border transition flex items-center justify-between font-medium">
                    <span>About</span>
                    <span class="font-mono text-xs text-slate-500">01</span>
                </a>
                <a href="#skills" @click.prevent="scrollTo('skills'); mobileMenuOpen = false" 
                   :class="activeSection === 'skills' ? 'bg-purple-600/20 text-purple-300 border-purple-500/30' : 'text-slate-300 hover:bg-white/5 border-transparent'" 
                   class="px-4 py-3 rounded-xl border transition flex items-center justify-between font-medium">
                    <span>Skills</span>
                    <span class="font-mono text-xs text-slate-500">02</span>
                </a>
                <a href="#experiences" @click.prevent="scrollTo('experiences'); mobileMenuOpen = false" 
                   :class="activeSection === 'experiences' ? 'bg-purple-600/20 text-purple-300 border-purple-500/30' : 'text-slate-300 hover:bg-white/5 border-transparent'" 
                   class="px-4 py-3 rounded-xl border transition flex items-center justify-between font-medium">
                    <span>Experience</span>
                    <span class="font-mono text-xs text-slate-500">03</span>
                </a>
                <a href="#projects" @click.prevent="scrollTo('projects'); mobileMenuOpen = false" 
                   :class="activeSection === 'projects' ? 'bg-purple-600/20 text-purple-300 border-purple-500/30' : 'text-slate-300 hover:bg-white/5 border-transparent'" 
                   class="px-4 py-3 rounded-xl border transition flex items-center justify-between font-medium">
                    <span>Projects</span>
                    <span class="font-mono text-xs text-slate-500">04</span>
                </a>
                <a href="#contact" @click.prevent="scrollTo('contact'); mobileMenuOpen = false" 
                   :class="activeSection === 'contact' ? 'bg-purple-600/20 text-purple-300 border-purple-500/30' : 'text-slate-300 hover:bg-white/5 border-transparent'" 
                   class="px-4 py-3 rounded-xl border transition flex items-center justify-between font-medium">
                    <span>Contact</span>
                    <span class="font-mono text-xs text-slate-500">05</span>
                </a>
            </div>
        </div>

        <div class="pt-6 border-t border-white/10">
            <a href="#contact" @click.prevent="scrollTo('contact'); mobileMenuOpen = false" class="w-full block text-center py-3 px-4 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold shadow-lg shadow-purple-600/30">
                Get in Touch
            </a>
        </div>
    </nav>

    <!-- Main Content Container -->
    <main class="relative z-10">

        <!-- Hero Section -->
        <section id="hero" class="min-h-screen flex items-center justify-center pt-28 pb-16 px-4 sm:px-6">
            <div class="max-w-4xl mx-auto text-center reveal is-visible" style="--reveal-delay: 100ms;">
                
                <!-- Status Badge -->
                <div class="inline-flex items-center gap-2.5 px-4 py-1.5 rounded-full glass-card border border-white/10 mb-8 animate-float-soft">
                    <span class="relative flex h-2.5 w-2.5">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                    </span>
                    <span class="font-mono text-xs text-emerald-400 font-medium tracking-wide">Available for new opportunities</span>
                </div>

                <!-- Main Headline -->
                <h1 class="text-4xl sm:text-6xl md:text-7xl font-display font-extrabold tracking-tight text-white mb-6 leading-[1.1]">
                    Hello, I'm <br class="hidden sm:inline">
                    <span class="text-gradient-purple">
                        {{ $profile->name ?? 'Full-Stack Developer' }}
                    </span>
                </h1>

                <!-- Subheadline -->
                <p class="text-xl sm:text-2xl md:text-3xl text-slate-300 font-light mb-6 tracking-tight">
                    {{ $profile->tagline ?? 'Crafting Scalable Web Applications & Modern Digital Experiences' }}
                </p>

                <!-- Bio Teaser -->
                <p class="max-w-2xl mx-auto text-slate-400 text-base sm:text-lg mb-10 leading-relaxed font-normal">
                    {{ $profile->bio ?? 'Passionate software engineer focused on building robust architectures, clean APIs, and elegant user interfaces.' }}
                </p>

                <!-- CTA Actions -->
                <div class="flex flex-wrap items-center justify-center gap-4 mb-14" x-data="{ copied: false }">
                    <a href="#projects" @click.prevent="scrollTo('projects')" 
                       class="interactive-lift inline-flex items-center gap-2 px-8 py-4 rounded-xl bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600 bg-size-200 text-white font-semibold text-base shadow-xl shadow-purple-600/30 hover:shadow-purple-600/50 transition-all">
                        <span>Explore Projects</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                        </svg>
                    </a>

                    <a href="#contact" @click.prevent="scrollTo('contact')" 
                       class="interactive-lift inline-flex items-center gap-2 px-8 py-4 rounded-xl glass-card text-slate-200 hover:text-white hover:border-purple-500/40 font-semibold text-base transition-all">
                        <span>Get In Touch</span>
                        <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </a>

                    @if($profile?->email)
                    <button type="button" 
                            @click="navigator.clipboard.writeText('{{ $profile->email }}'); copied = true; setTimeout(() => copied = false, 2500)" 
                            class="interactive-lift inline-flex items-center gap-2 px-5 py-4 rounded-xl bg-white/5 border border-white/10 hover:border-white/20 text-slate-300 hover:text-white font-mono text-sm transition">
                        <svg x-show="!copied" class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3"/>
                        </svg>
                        <svg x-show="copied" class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <span x-text="copied ? 'Email Copied!' : 'Copy Email'"></span>
                    </button>
                    @endif
                </div>

                <!-- Tech Ticker Bar -->
                <div class="pt-8 border-t border-white/5">
                    <p class="font-mono text-xs uppercase tracking-widest text-slate-500 mb-4">Core Technology Stack</p>
                    <div class="flex flex-wrap items-center justify-center gap-2 sm:gap-3">
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">Laravel 12</span>
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">Livewire 4</span>
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">PHP 8.3</span>
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">Tailwind CSS</span>
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">MySQL & SQLite</span>
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">Docker</span>
                        <span class="px-3.5 py-1.5 rounded-lg bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300 hover:border-purple-500/40 hover:text-purple-300 transition">REST APIs</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- About Bento Grid Section -->
        <section id="about" class="py-24 px-4 sm:px-6 relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 reveal" style="--reveal-delay: 100ms;">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 font-mono text-xs mb-3">
                        <span>01. ABOUT ME</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-display font-bold text-white tracking-tight">Behind the Code</h2>
                </div>

                <!-- Bento Box Grid -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <!-- Bento Card 1: Main Story & Profile (Spans 2 cols) -->
                    <div class="md:col-span-2 glass-card glass-card-hover rounded-3xl p-8 sm:p-10 flex flex-col justify-between reveal" style="--reveal-delay: 120ms;">
                        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 mb-8">
                            <div class="relative group">
                                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-500 p-1 shadow-xl shadow-purple-500/20">
                                    @if($profile?->photo)
                                        <img src="{{ Storage::url($profile->photo) }}" alt="{{ $profile->name }}" class="w-full h-full object-cover rounded-xl">
                                    @else
                                        <div class="w-full h-full bg-[#0d1322] rounded-xl flex items-center justify-center font-display font-bold text-white text-3xl">
                                            {{ substr($profile->name ?? 'A', 0, 1) }}
                                        </div>
                                    @endif
                                </div>
                                <div class="absolute -bottom-2 -right-2 px-2.5 py-0.5 rounded-full bg-emerald-500/90 text-white font-mono text-[10px] font-bold tracking-wider uppercase shadow-md">
                                    PRO
                                </div>
                            </div>
                            <div>
                                <h3 class="text-2xl font-display font-bold text-white">{{ $profile->name ?? 'Developer' }}</h3>
                                <p class="text-purple-400 font-medium text-sm mb-3">{{ $profile->tagline ?? 'Full-Stack Software Engineer' }}</p>
                                @if($profile?->location)
                                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs text-slate-300 font-mono">
                                        <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                        <span>{{ $profile->location }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="text-slate-300 text-base leading-relaxed space-y-4 font-normal">
                            <p>{{ $profile->bio ?? 'I specialize in creating end-to-end web architectures that balance clean code, performance, and delightful user experiences.' }}</p>
                            <p class="text-slate-400 text-sm">When building solutions, I emphasize maintainable patterns (Thin Controllers, Dedicated Services, Form Requests, Query Optimization) and production reliability.</p>
                        </div>

                        <div class="pt-8 mt-8 border-t border-white/5 flex flex-wrap items-center gap-4">
                            @if($profile?->github)
                            <a href="{{ $profile->github }}" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl bg-white/5 border border-white/10 hover:border-purple-500/40 hover:bg-white/10 text-slate-300 hover:text-white transition group" title="GitHub">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                            @endif
                            @if($profile?->linkedin)
                            <a href="{{ $profile->linkedin }}" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl bg-white/5 border border-white/10 hover:border-purple-500/40 hover:bg-white/10 text-slate-300 hover:text-white transition group" title="LinkedIn">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                                </svg>
                            </a>
                            @endif
                            @if($profile?->twitter)
                            <a href="{{ $profile->twitter }}" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl bg-white/5 border border-white/10 hover:border-purple-500/40 hover:bg-white/10 text-slate-300 hover:text-white transition group" title="X (Twitter)">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.746l7.73-8.835L1.254 2.25H8.08l4.259 5.63L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
                                </svg>
                            </a>
                            @endif
                            @if($profile?->whatsapp)
                            <a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" rel="noopener noreferrer" class="p-3 rounded-xl bg-white/5 border border-white/10 hover:border-emerald-500/40 hover:bg-white/10 text-emerald-400 hover:text-emerald-300 transition group" title="WhatsApp">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Bento Card 2: Core Philosophy & Architecture (1 col) -->
                    <div class="glass-card glass-card-hover rounded-3xl p-8 flex flex-col justify-between reveal" style="--reveal-delay: 140ms;">
                        <div>
                            <div class="w-12 h-12 rounded-2xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 mb-6">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                                </svg>
                            </div>
                            <h3 class="text-xl font-display font-bold text-white mb-4">Engineering Principles</h3>
                            <ul class="space-y-3 text-sm text-slate-300 font-normal">
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Clean & Scalable Architecture</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Database & Query Optimization</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Security-First Practices</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span>Modern Reactive Frontends</span>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-8 pt-6 border-t border-white/5">
                            <span class="font-mono text-xs text-purple-400">⚡ High Performance Standard</span>
                        </div>
                    </div>

                    <!-- Bento Card 3: Metrics & Numbers (1 col) -->
                    <div class="glass-card glass-card-hover rounded-3xl p-8 flex flex-col justify-between reveal" style="--reveal-delay: 160ms;">
                        <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 border border-indigo-500/20 flex items-center justify-center text-indigo-400 mb-6">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-4xl font-display font-extrabold text-white mb-1">
                                {{ $totalProjects > 0 ? $totalProjects . '+' : '5+' }}
                            </div>
                            <p class="text-xs font-mono text-slate-400 uppercase tracking-wider mb-6">Featured Projects Built</p>

                            <div class="text-4xl font-display font-extrabold text-purple-400 mb-1">
                                {{ $totalSkills > 0 ? $totalSkills . '+' : '15+' }}
                            </div>
                            <p class="text-xs font-mono text-slate-400 uppercase tracking-wider">Technologies & Frameworks</p>
                        </div>
                        <div class="mt-8 pt-6 border-t border-white/5">
                            <span class="font-mono text-xs text-slate-400">💯 Clean Code Commitment</span>
                        </div>
                    </div>

                    <!-- Bento Card 4: Direct Action & Collaboration (Spans 2 cols) -->
                    <div class="md:col-span-2 glass-card glass-card-hover rounded-3xl p-8 sm:p-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 reveal" style="--reveal-delay: 180ms;">
                        <div>
                            <h3 class="text-2xl font-display font-bold text-white mb-2">Have a project in mind?</h3>
                            <p class="text-slate-400 text-sm max-w-md">Whether you need a full web application, API integration, or performance overhaul, let's talk.</p>
                        </div>
                        <a href="#contact" @click.prevent="scrollTo('contact')" class="interactive-lift inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-500 hover:to-indigo-500 text-white font-semibold text-sm shadow-lg shadow-purple-600/30 whitespace-nowrap">
                            <span>Start a Conversation</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
        </section>

        <!-- Skills Section -->
        <section id="skills" class="py-24 px-4 sm:px-6 relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 reveal" style="--reveal-delay: 100ms;">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-indigo-500/10 border border-indigo-500/20 text-indigo-400 font-mono text-xs mb-3">
                        <span>02. TECHNICAL SKILLS</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-display font-bold text-white tracking-tight">Skills & Tech Stack</h2>
                    <p class="text-slate-400 text-base max-w-2xl mx-auto mt-4">Continuously expanding my toolkit to engineer robust backend systems and intuitive frontend interfaces.</p>
                </div>

                @if($skills->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($skills as $category => $categorySkills)
                    <div class="glass-card glass-card-hover rounded-3xl p-8 flex flex-col justify-between reveal" style="--reveal-delay: {{ 100 + ($loop->index * 40) }}ms;">
                        <div>
                            <!-- Header -->
                            <div class="flex items-center justify-between mb-6 pb-4 border-b border-white/5">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-xl font-display font-bold text-white">{{ $category }}</h3>
                                </div>
                                <span class="font-mono text-xs text-slate-500">{{ count($categorySkills) }} skills</span>
                            </div>

                            <!-- Skill Items with Progress -->
                            <div class="space-y-5">
                                @foreach($categorySkills as $skill)
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="font-medium text-slate-200">{{ $skill->name }}</span>
                                        <span class="font-mono text-xs text-purple-300">{{ $skill->level }}%</span>
                                    </div>
                                    <div class="w-full bg-white/5 border border-white/5 rounded-full h-2 overflow-hidden p-[1px]">
                                        <div class="bg-gradient-to-r from-purple-600 via-indigo-500 to-cyan-400 h-full rounded-full transition-all duration-1000 ease-out" 
                                             style="width: {{ $skill->level }}%"></div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="mt-8 pt-4 border-t border-white/5 flex items-center justify-between text-xs text-slate-500 font-mono">
                            <span>Proficiency</span>
                            <span>Advanced</span>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="glass-card rounded-3xl p-12 text-center text-slate-500 font-mono">
                    No skills published yet.
                </div>
                @endif
            </div>
        </section>

        <!-- Experience Timeline Section -->
        <section id="experiences" class="py-24 px-4 sm:px-6 relative">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-16 reveal" style="--reveal-delay: 100ms;">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 font-mono text-xs mb-3">
                        <span>03. WORK JOURNEY</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-display font-bold text-white tracking-tight">Work Experience</h2>
                    <p class="text-slate-400 text-base max-w-2xl mx-auto mt-4">Professional career milestones and key engineering responsibilities.</p>
                </div>

                @if($experiences->isNotEmpty())
                <div class="relative pl-6 sm:pl-10 space-y-10 before:content-[''] before:absolute before:top-4 before:bottom-4 before:left-2 sm:before:left-3.5 before:w-0.5 before:bg-gradient-to-b before:from-purple-500 before:via-indigo-500 before:to-transparent">
                    @foreach($experiences as $experience)
                    <div class="relative group reveal" style="--reveal-delay: {{ 100 + ($loop->index * 60) }}ms;">
                        <!-- Timeline Node Dot -->
                        <div class="absolute -left-[29px] sm:-left-[39px] top-6 w-4 h-4 rounded-full bg-[#080c14] border-2 border-purple-400 group-hover:border-cyan-400 group-hover:scale-125 transition-all shadow-md shadow-purple-500/30"></div>

                        <!-- Card Content -->
                        <div class="glass-card glass-card-hover rounded-3xl p-6 sm:p-8">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                                <div>
                                    <h3 class="text-xl sm:text-2xl font-display font-bold text-white group-hover:text-purple-300 transition">
                                        {{ $experience->position }}
                                    </h3>
                                    <div class="inline-flex items-center gap-2 text-indigo-400 font-medium text-sm mt-0.5">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                        <span>{{ $experience->company }}</span>
                                    </div>
                                </div>

                                <span class="self-start sm:self-auto inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs font-mono text-slate-300">
                                    <svg class="w-3.5 h-3.5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>
                                        {{ $experience->start_date?->format('M Y') }} — {{ $experience->end_date?->format('M Y') ?? 'Present' }}
                                    </span>
                                </span>
                            </div>

                            <p class="text-slate-300 text-sm sm:text-base leading-relaxed font-normal whitespace-pre-line">
                                {{ $experience->description }}
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="glass-card rounded-3xl p-12 text-center text-slate-500 font-mono">
                    No work experience listed yet.
                </div>
                @endif
            </div>
        </section>

        <!-- Featured Projects Showcase Section -->
        <section id="projects" class="py-24 px-4 sm:px-6 relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 reveal" style="--reveal-delay: 100ms;">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-purple-500/10 border border-purple-500/20 text-purple-400 font-mono text-xs mb-3">
                        <span>04. PORTFOLIO SHOWCASE</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-display font-bold text-white tracking-tight">Featured Projects</h2>
                    <p class="text-slate-400 text-base max-w-2xl mx-auto mt-4">A curated collection of full-stack applications, scalable APIs, and client systems.</p>
                </div>

                @if($projects->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($projects as $project)
                    <div class="glass-card glass-card-hover rounded-3xl overflow-hidden flex flex-col justify-between group reveal" style="--reveal-delay: {{ 100 + ($loop->index * 60) }}ms;">
                        <div>
                            <!-- Project Image Container -->
                            <div class="relative aspect-video w-full overflow-hidden bg-[#0d1424] border-b border-white/5">
                                @if($project->image)
                                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500 ease-out">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-purple-900/40 via-indigo-900/30 to-[#080c14] flex items-center justify-center">
                                        <span class="font-display font-extrabold text-5xl text-purple-400/40">
                                            {{ substr($project->title, 0, 1) }}
                                        </span>
                                    </div>
                                @endif
                                
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0d1424] via-transparent to-transparent opacity-80"></div>
                                
                                <div class="absolute top-3 left-3">
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-600/80 backdrop-blur-md text-white font-mono text-[11px] font-semibold tracking-wide border border-purple-400/30">
                                        ★ Featured
                                    </span>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="p-6 sm:p-7">
                                <h3 class="text-xl font-display font-bold text-white mb-2.5 group-hover:text-purple-300 transition flex items-center justify-between">
                                    <span>{{ $project->title }}</span>
                                    <svg class="w-4 h-4 text-slate-500 group-hover:text-purple-400 group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                    </svg>
                                </h3>

                                <p class="text-slate-400 text-sm line-clamp-3 mb-5 leading-relaxed font-normal">
                                    {{ $project->description }}
                                </p>

                                @if($project->tech_stack)
                                <div class="flex flex-wrap gap-1.5 mb-6">
                                    @foreach($project->tech_stack as $tech)
                                    <span class="px-2.5 py-1 rounded-md bg-white/[0.04] border border-white/10 font-mono text-xs text-slate-300">
                                        {{ $tech }}
                                    </span>
                                    @endforeach
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Card Footer Buttons -->
                        <div class="px-6 pb-6 pt-0 flex gap-3">
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-purple-600 hover:bg-purple-500 text-white font-medium text-xs shadow-md shadow-purple-600/20 transition">
                                <span>Live Demo</span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                            @endif

                            @if($project->repo_url)
                            <a href="{{ $project->repo_url }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex items-center justify-center gap-2 py-2.5 px-4 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-slate-200 hover:text-white font-medium text-xs transition">
                                <span>Source Code</span>
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                                </svg>
                            </a>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="glass-card rounded-3xl p-12 text-center text-slate-500 font-mono">
                    No featured projects published yet.
                </div>
                @endif
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="py-24 px-4 sm:px-6 relative">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 reveal" style="--reveal-delay: 100ms;">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-mono text-xs mb-3">
                        <span>05. GET IN TOUCH</span>
                    </div>
                    <h2 class="text-3xl sm:text-5xl font-display font-bold text-white tracking-tight">Let's Connect</h2>
                    <p class="text-slate-400 text-base max-w-2xl mx-auto mt-4">Have an inquiry, project proposal, or looking to collaborate? Drop me a line below.</p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
                    
                    <!-- Left Column: Contact Channels & Info -->
                    <div class="lg:col-span-5 space-y-6 reveal" style="--reveal-delay: 120ms;">
                        <div class="glass-card rounded-3xl p-8">
                            <h3 class="text-xl font-display font-bold text-white mb-3">Direct Channels</h3>
                            <p class="text-slate-400 text-sm mb-6 leading-relaxed">Feel free to reach out via direct message or through the contact form. I typically respond within 24 hours.</p>

                            <div class="space-y-4">
                                @if($profile?->email)
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-purple-500/30 transition group">
                                    <div class="w-11 h-11 rounded-xl bg-purple-500/10 border border-purple-500/20 flex items-center justify-center text-purple-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-xs text-slate-500 font-mono uppercase">Email Address</p>
                                        <a href="mailto:{{ $profile->email }}" class="text-sm font-medium text-slate-200 hover:text-purple-300 transition truncate block">
                                            {{ $profile->email }}
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if($profile?->whatsapp)
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/[0.03] border border-white/5 hover:border-emerald-500/30 transition group">
                                    <div class="w-11 h-11 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-400 shrink-0">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                        </svg>
                                    </div>
                                    <div class="overflow-hidden">
                                        <p class="text-xs text-slate-500 font-mono uppercase">WhatsApp</p>
                                        <a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" rel="noopener noreferrer" class="text-sm font-medium text-slate-200 hover:text-emerald-400 transition truncate block">
                                            +{{ $profile->whatsapp }}
                                        </a>
                                    </div>
                                </div>
                                @endif

                                @if($profile?->location)
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white/[0.03] border border-white/5">
                                    <div class="w-11 h-11 rounded-xl bg-cyan-500/10 border border-cyan-500/20 flex items-center justify-center text-cyan-400 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-xs text-slate-500 font-mono uppercase">Location</p>
                                        <p class="text-sm font-medium text-slate-200">{{ $profile->location }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Livewire Contact Form -->
                    <div class="lg:col-span-7 reveal" style="--reveal-delay: 140ms;">
                        <div class="glass-card rounded-3xl p-8 sm:p-10 border border-white/10 shadow-2xl">
                            <h3 class="text-2xl font-display font-bold text-white mb-2">Send a Message</h3>
                            <p class="text-slate-400 text-sm mb-8">Fill in the fields below and I'll get back to you promptly.</p>
                            
                            <livewire:contact-form />
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>

    <!-- Modern Footer -->
    <footer class="border-t border-white/10 py-12 relative z-10 bg-[#06090f]/80 backdrop-blur-md">
        <div class="max-w-6xl mx-auto px-4 sm:px-6">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-6">
                
                <!-- Left: Status & Copyright -->
                <div class="flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/5 text-xs font-mono text-slate-400">
                        <span class="w-2 h-2 rounded-full bg-emerald-400"></span>
                        <span>All Systems Normal</span>
                    </div>
                    <p class="text-slate-400 text-xs font-mono">
                        © {{ date('Y') }} {{ $profile->name ?? 'Portfolio' }}. Built with Laravel 12 & Livewire.
                    </p>
                </div>

                <!-- Right: Social Links & Back to top -->
                <div class="flex items-center gap-4">
                    @if($profile?->github)
                    <a href="{{ $profile->github }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-white transition" title="GitHub">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                        </svg>
                    </a>
                    @endif

                    @if($profile?->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" rel="noopener noreferrer" class="text-slate-400 hover:text-white transition" title="LinkedIn">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    @endif

                    <!-- Back to Top Button -->
                    <button @click="scrollTo('hero')" class="p-2.5 rounded-full bg-white/5 border border-white/10 hover:bg-white/10 text-slate-300 hover:text-white transition" title="Back to top">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                        </svg>
                    </button>
                </div>

            </div>
        </div>
    </footer>

    <!-- Toast Notification Banner -->
    <div x-data="{ show: false, message: '' }" 
         @notify.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 4000)"
         x-show="show" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4"
         class="fixed bottom-6 right-6 z-50 glass-panel border border-emerald-500/30 px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 text-white">
        <div class="w-8 h-8 rounded-xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center shrink-0">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
        </div>
        <div>
            <p class="font-medium text-sm text-slate-100" x-text="message"></p>
        </div>
    </div>

    <!-- Floating WhatsApp Widget -->
    @if($profile?->whatsapp)
    <a href="https://wa.me/{{ $profile->whatsapp }}" target="_blank" rel="noopener noreferrer"
       class="fixed bottom-6 left-6 z-40 flex items-center justify-center w-14 h-14 bg-emerald-500 hover:bg-emerald-400 rounded-full shadow-2xl shadow-emerald-500/40 hover:scale-110 active:scale-95 transition-all duration-300 group"
       title="Chat directly via WhatsApp">
        <span class="absolute -top-1 -right-1 flex h-3.5 w-3.5">
            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
            <span class="relative inline-flex rounded-full h-3.5 w-3.5 bg-emerald-300"></span>
        </span>
        <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
        </svg>
    </a>
    @endif

    <script>
        function portfolio() {
            return {
                activeSection: 'hero',
                mobileMenuOpen: false,
                init() {
                    const observer = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.activeSection = entry.target.id;
                                entry.target.classList.add('is-visible');
                            }
                        });
                    }, { threshold: 0.2 });
                    
                    document.querySelectorAll('section[id], .reveal').forEach(el => {
                        observer.observe(el);
                    });
                },
                scrollTo(id) {
                    const el = document.getElementById(id);
                    if (el) {
                        el.scrollIntoView({ behavior: 'smooth' });
                    }
                }
            }
        }
    </script>

    @livewireScripts
</body>
</html>
