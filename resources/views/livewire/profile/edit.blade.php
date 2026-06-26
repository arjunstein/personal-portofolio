<div>
    <h1 class="text-3xl font-bold mb-8">Edit Profile</h1>

    <form wire:submit="save" class="max-w-3xl space-y-6">
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6 space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                <input type="text" wire:model="name" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                @error('name') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Tagline</label>
                <input type="text" wire:model="tagline" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Bio</label>
                <textarea wire:model="bio" rows="4" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"></textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Photo</label>
                @if($profile?->photo && !$photo)
                <div class="mb-2">
                    <img src="{{ Storage::url($profile->photo) }}" class="h-24 w-24 rounded-full object-cover">
                    <p class="text-sm text-gray-400 mt-1">Current photo</p>
                </div>
                @endif
                <input type="file" wire:model="photo" accept="image/*" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100">
                @error('photo') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                @if($photo)
                <img src="{{ $photo->temporaryUrl() }}" class="mt-4 h-24 w-24 rounded-full object-cover">
                @endif
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" wire:model="email" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    @error('email') <span class="text-red-400 text-sm">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Phone</label>
                    <input type="text" wire:model="phone" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                </div>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-300 mb-2">Location</label>
                <input type="text" wire:model="location" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
            </div>

            <div class="border-t border-gray-700 pt-6">
                <h3 class="text-lg font-semibold mb-4">Social Links</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">GitHub</label>
                        <input type="url" wire:model="github" placeholder="https://github.com/username" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">LinkedIn</label>
                        <input type="url" wire:model="linkedin" placeholder="https://linkedin.com/in/username" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Twitter</label>
                        <input type="url" wire:model="twitter" placeholder="https://twitter.com/username" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Instagram</label>
                        <input type="url" wire:model="instagram" placeholder="https://instagram.com/username" class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
            Save Profile
        </button>
    </form>
</div>
