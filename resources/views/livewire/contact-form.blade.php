<div class="w-full max-w-2xl mx-auto">
    <form wire:submit="submit" class="space-y-6">
        @error('rate_limit') <div class="rounded-lg border border-red-500/20 bg-red-500/10 px-4 py-3 text-sm text-red-300">{{ $message }}</div> @enderror
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
            <input type="text" wire:model="name" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
            <input type="email" wire:model="email" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Subject</label>
            <input type="text" wire:model="subject" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
            @error('subject') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-300 mb-2">Message</label>
            <textarea wire:model="message" rows="5" class="w-full px-4 py-3 bg-gray-800 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500 focus:border-transparent"></textarea>
            @error('message') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-indigo-700 transition">
            Send Message
        </button>
    </form>
</div>
