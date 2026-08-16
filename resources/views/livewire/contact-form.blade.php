<div class="w-full">
    <form wire:submit="submit" class="space-y-5">
        @error('rate_limit') 
        <div class="rounded-2xl border border-red-500/30 bg-red-500/10 px-5 py-4 text-sm text-red-300 flex items-center gap-3">
            <svg class="w-5 h-5 text-red-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
            </svg>
            <span>{{ $message }}</span>
        </div> 
        @enderror

        <!-- Name Field -->
        <div>
            <label class="block text-xs font-mono uppercase tracking-wider text-slate-400 mb-2">Your Name</label>
            <div class="relative">
                <input type="text" 
                       wire:model="name" 
                       placeholder="e.g. Sarah Connor" 
                       class="w-full px-4 py-3.5 bg-white/[0.03] border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition duration-200">
            </div>
            @error('name') 
                <span class="inline-flex items-center gap-1 text-red-400 text-xs font-mono mt-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $message }}</span>
                </span> 
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label class="block text-xs font-mono uppercase tracking-wider text-slate-400 mb-2">Email Address</label>
            <div class="relative">
                <input type="email" 
                       wire:model="email" 
                       placeholder="sarah@example.com" 
                       class="w-full px-4 py-3.5 bg-white/[0.03] border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition duration-200">
            </div>
            @error('email') 
                <span class="inline-flex items-center gap-1 text-red-400 text-xs font-mono mt-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $message }}</span>
                </span> 
            @enderror
        </div>

        <!-- Subject Field -->
        <div>
            <label class="block text-xs font-mono uppercase tracking-wider text-slate-400 mb-2">Subject</label>
            <div class="relative">
                <input type="text" 
                       wire:model="subject" 
                       placeholder="Project inquiry / Opportunity" 
                       class="w-full px-4 py-3.5 bg-white/[0.03] border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition duration-200">
            </div>
            @error('subject') 
                <span class="inline-flex items-center gap-1 text-red-400 text-xs font-mono mt-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $message }}</span>
                </span> 
            @enderror
        </div>

        <!-- Message Field -->
        <div>
            <label class="block text-xs font-mono uppercase tracking-wider text-slate-400 mb-2">Message</label>
            <div class="relative">
                <textarea wire:model="message" 
                          rows="4" 
                          placeholder="Tell me about your project, timeline, and goals..." 
                          class="w-full px-4 py-3.5 bg-white/[0.03] border border-white/10 rounded-xl text-slate-100 placeholder-slate-500 text-sm focus:outline-none focus:border-purple-500 focus:ring-2 focus:ring-purple-500/20 transition duration-200 resize-y"></textarea>
            </div>
            @error('message') 
                <span class="inline-flex items-center gap-1 text-red-400 text-xs font-mono mt-1.5">
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ $message }}</span>
                </span> 
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" 
                wire:loading.attr="disabled"
                class="w-full inline-flex items-center justify-center gap-2 py-4 px-6 rounded-xl bg-gradient-to-r from-purple-600 via-indigo-600 to-purple-600 text-white font-semibold text-sm shadow-xl shadow-purple-600/25 hover:shadow-purple-600/40 hover:scale-[1.01] active:scale-[0.99] disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 cursor-pointer">
            
            <!-- Default state -->
            <span wire:loading.remove class="flex items-center gap-2">
                <span>Send Message</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </span>

            <!-- Loading state -->
            <span wire:loading class="flex items-center gap-2">
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>Sending message...</span>
            </span>
        </button>
    </form>
</div>
