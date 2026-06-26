@php
    $profile = \App\Models\Profile::first();
    $skills = \App\Models\Skill::orderBy('sort_order')->get()->groupBy('category');
    $experiences = \App\Models\Experience::orderBy('sort_order')->get();
    $projects = \App\Models\Project::where('is_featured', true)->orderBy('sort_order')->get();
@endphp
<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $profile->name ?? 'Portfolio' }} - {{ $profile->tagline ?? 'Developer' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-900 text-gray-100" x-data="portfolio()" x-init="init()">
    
    <!-- Navigation -->
    <nav x-ref="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 bg-gray-900/80 backdrop-blur-sm border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <a href="#hero" @click.prevent="scrollTo('hero')" class="text-2xl font-bold bg-gradient-to-r from-purple-400 to-indigo-400 bg-clip-text text-transparent">
                    {{ $profile->name ?? 'Portfolio' }}
                </a>
                <div class="hidden md:flex gap-8">
                    <a href="#hero" @click.prevent="scrollTo('hero')" :class="activeSection === 'hero' ? 'text-purple-400' : 'text-gray-300 hover:text-white'" class="transition">Home</a>
                    <a href="#about" @click.prevent="scrollTo('about')" :class="activeSection === 'about' ? 'text-purple-400' : 'text-gray-300 hover:text-white'" class="transition">About</a>
                    <a href="#skills" @click.prevent="scrollTo('skills')" :class="activeSection === 'skills' ? 'text-purple-400' : 'text-gray-300 hover:text-white'" class="transition">Skills</a>
                    <a href="#experiences" @click.prevent="scrollTo('experiences')" :class="activeSection === 'experiences' ? 'text-purple-400' : 'text-gray-300 hover:text-white'" class="transition">Experience</a>
                    <a href="#projects" @click.prevent="scrollTo('projects')" :class="activeSection === 'projects' ? 'text-purple-400' : 'text-gray-300 hover:text-white'" class="transition">Projects</a>
                    <a href="#contact" @click.prevent="scrollTo('contact')" :class="activeSection === 'contact' ? 'text-purple-400' : 'text-gray-300 hover:text-white'" class="transition">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="hero" class="min-h-screen flex items-center justify-center relative overflow-hidden pt-20">
        <div class="absolute inset-0 bg-gradient-to-br from-purple-900/20 to-indigo-900/20"></div>
        <div class="max-w-7xl mx-auto px-6 py-20 text-center relative z-10 reveal is-visible" style="--reveal-delay: 100ms;">
            <h1 class="text-5xl md:text-7xl font-bold mb-6">
                <span class="bg-gradient-to-r from-purple-400 via-pink-400 to-indigo-400 bg-clip-text text-transparent">
                    {{ $profile->name ?? 'Your Name' }}
                </span>
            </h1>
            <p class="text-2xl md:text-3xl text-gray-300 mb-8">{{ $profile->tagline ?? 'Full-Stack Developer' }}</p>
            <div class="flex gap-4 justify-center animate-float-soft">
                <a href="#projects" @click.prevent="scrollTo('projects')" class="interactive-lift px-8 py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-lg hover:from-purple-700 hover:to-indigo-700 transition">
                    View My Work
                </a>
                <a href="#contact" @click.prevent="scrollTo('contact')" class="interactive-lift px-8 py-4 bg-gray-800 text-white rounded-lg hover:bg-gray-700 transition">
                    Get In Touch
                </a>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="min-h-screen flex items-center py-20 reveal" style="--reveal-delay: 120ms;">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">About Me</h2>
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    @if($profile?->photo)
                    <img src="{{ Storage::url($profile->photo) }}" alt="{{ $profile->name }}" class="rounded-2xl w-full max-w-md mx-auto shadow-2xl">
                    @else
                    <div class="w-full max-w-md mx-auto h-96 bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl flex items-center justify-center">
                        <span class="text-8xl font-bold text-white">{{ substr($profile->name ?? 'U', 0, 1) }}</span>
                    </div>
                    @endif
                </div>
                <div>
                    <p class="text-lg text-gray-300 mb-6 leading-relaxed">{{ $profile->bio ?? 'Passionate developer building amazing web applications.' }}</p>
                    <div class="space-y-3 mb-8">
                        @if($profile?->email)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            <span>{{ $profile->email }}</span>
                        </div>
                        @endif
                        @if($profile?->location)
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            <span>{{ $profile->location }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex gap-4">
                        @if($profile?->github)
                        <a href="{{ $profile->github }}" target="_blank" class="p-3 bg-gray-800 rounded-lg hover:bg-gray-700 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/>
                            </svg>
                        </a>
                        @endif
                        @if($profile?->linkedin)
                        <a href="{{ $profile->linkedin }}" target="_blank" class="p-3 bg-gray-800 rounded-lg hover:bg-gray-700 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                        </a>
                        @endif
                        @if($profile?->twitter)
                        <a href="{{ $profile->twitter }}" target="_blank" class="p-3 bg-gray-800 rounded-lg hover:bg-gray-700 transition">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"/>
                            </svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Skills Section -->
    <section id="skills" class="min-h-screen flex items-center py-20 bg-gray-800/30 reveal" style="--reveal-delay: 120ms;">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">Skills & Expertise</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($skills as $category => $categorySkills)
                <div class="interactive-lift bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-2xl font-semibold mb-6 text-purple-400">{{ $category }}</h3>
                    <div class="space-y-4">
                        @foreach($categorySkills as $skill)
                        <div>
                            <div class="flex justify-between mb-2">
                                <span class="font-medium">{{ $skill->name }}</span>
                                <span class="text-gray-400">{{ $skill->level }}%</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2">
                                <div class="bg-gradient-to-r from-purple-600 to-indigo-600 h-2 rounded-full transition-all duration-1000" style="width: {{ $skill->level }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experiences" class="min-h-screen flex items-center py-20 reveal" style="--reveal-delay: 120ms;">
        <div class="max-w-5xl mx-auto px-6 w-full">
            <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">Work Experience</h2>
            <div class="space-y-6">
                @forelse($experiences as $experience)
                <div class="interactive-lift rounded-2xl border border-gray-700 bg-gray-800/70 p-6 md:p-8">
                    <div class="flex flex-col gap-4 md:flex-row md:items-start md:justify-between">
                        <div>
                            <h3 class="text-2xl font-semibold text-white">{{ $experience->position }}</h3>
                            <p class="mt-1 text-lg text-purple-400">{{ $experience->company }}</p>
                        </div>
                        <div class="rounded-full bg-gray-700 px-4 py-2 text-sm text-gray-300">
                            {{ $experience->start_date?->format('M Y') }} - {{ $experience->end_date?->format('M Y') ?? 'Present' }}
                        </div>
                    </div>
                    <p class="mt-4 leading-relaxed text-gray-300">{{ $experience->description }}</p>
                </div>
                @empty
                <div class="text-center text-gray-500 py-12">No experiences yet</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Projects Section -->
    <section id="projects" class="min-h-screen flex items-center py-20 reveal" style="--reveal-delay: 120ms;">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">Featured Projects</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($projects as $project)
                <div class="interactive-lift bg-gray-800 rounded-xl overflow-hidden border border-gray-700 hover:border-purple-500 transition group">
                    @if($project->image)
                    <img src="{{ Storage::url($project->image) }}" alt="{{ $project->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition duration-300">
                    @else
                    <div class="w-full h-48 bg-gradient-to-br from-purple-600 to-indigo-600 flex items-center justify-center">
                        <span class="text-4xl font-bold text-white">{{ substr($project->title, 0, 1) }}</span>
                    </div>
                    @endif
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-3">{{ $project->title }}</h3>
                        <p class="text-gray-400 mb-4 line-clamp-3">{{ $project->description }}</p>
                        @if($project->tech_stack)
                        <div class="flex flex-wrap gap-2 mb-4">
                            @foreach($project->tech_stack as $tech)
                            <span class="px-3 py-1 bg-gray-700 text-sm rounded-full">{{ $tech }}</span>
                            @endforeach
                        </div>
                        @endif
                        <div class="flex gap-4">
                            @if($project->demo_url)
                            <a href="{{ $project->demo_url }}" target="_blank" class="flex-1 text-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                                Demo
                            </a>
                            @endif
                            @if($project->repo_url)
                            <a href="{{ $project->repo_url }}" target="_blank" class="flex-1 text-center px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition">
                                Code
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-500 py-12">No featured projects yet</div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="min-h-screen flex items-center py-20 bg-gray-800/30 reveal" style="--reveal-delay: 120ms;">
        <div class="max-w-7xl mx-auto px-6 w-full">
            <h2 class="text-4xl md:text-5xl font-bold mb-12 text-center">Get In Touch</h2>
            <div class="max-w-2xl mx-auto">
                <p class="text-center text-gray-300 mb-8">Have a question or want to work together? Send me a message!</p>
                <livewire:contact-form />
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 border-t border-gray-700 py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-gray-400">© {{ date('Y') }} {{ $profile->name ?? 'Portfolio' }}. All rights reserved.</p>
                <div class="flex gap-4">
                    @if($profile?->github)
                    <a href="{{ $profile->github }}" target="_blank" class="text-gray-400 hover:text-white transition">GitHub</a>
                    @endif
                    @if($profile?->linkedin)
                    <a href="{{ $profile->linkedin }}" target="_blank" class="text-gray-400 hover:text-white transition">LinkedIn</a>
                    @endif
                    @if($profile?->twitter)
                    <a href="{{ $profile->twitter }}" target="_blank" class="text-gray-400 hover:text-white transition">Twitter</a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notification -->
    <div x-data="{ show: false, message: '' }" 
         @notify.window="message = $event.detail.message; show = true; setTimeout(() => show = false, 3000)"
         x-show="show" 
         x-transition
         class="fixed bottom-4 right-4 bg-purple-600 text-white px-6 py-3 rounded-lg shadow-lg z-50">
        <p x-text="message"></p>
    </div>

    <script>
        function portfolio() {
            return {
                activeSection: 'hero',
                init() {
                    const observer = new IntersectionObserver(entries => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                this.activeSection = entry.target.id;
                                entry.target.classList.add('is-visible');
                                window.history.replaceState(null, '', `#${entry.target.id}`);
                            }
                        });
                    }, { threshold: 0.25 });
                    
                    document.querySelectorAll('section[id]').forEach(section => {
                        observer.observe(section);
                    });
                },
                scrollTo(id) {
                    document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
                }
            }
        }
    </script>

    @livewireScripts
</body>
</html>
