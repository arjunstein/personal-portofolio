<div>
    <h1 class="text-3xl font-bold mb-8">Account Settings</h1>

    <div class="max-w-2xl mx-auto space-y-6">

        {{-- Update username / email --}}
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
            <h2 class="text-xl font-semibold mb-1">Account Information</h2>
            <p class="text-sm text-gray-400 mb-6">Update your login username and email address.</p>

            <form wire:submit="updateAccount" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Username</label>
                    <input type="text" wire:model="name"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"
                           required autocomplete="name">
                    @error('name') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" wire:model="email"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"
                           required autocomplete="email">
                    @error('email') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        {{-- Update password --}}
        <div class="bg-gray-800 rounded-lg border border-gray-700 p-6">
            <h2 class="text-xl font-semibold mb-1">Change Password</h2>
            <p class="text-sm text-gray-400 mb-6">Use a long, random password to keep your account secure.</p>

            <form wire:submit="updatePassword" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Current Password</label>
                    <input type="password" wire:model="current_password"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"
                           autocomplete="current-password">
                    @error('current_password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">New Password</label>
                    <input type="password" wire:model="password"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"
                           autocomplete="new-password">
                    @error('password') <span class="text-red-400 text-sm mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-300 mb-2">Confirm New Password</label>
                    <input type="password" wire:model="password_confirmation"
                           class="w-full px-4 py-3 bg-gray-900 border border-gray-700 rounded-lg text-gray-100 focus:ring-2 focus:ring-purple-500"
                           autocomplete="new-password">
                </div>

                <div class="pt-2">
                    <button type="submit"
                            class="px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                        Update Password
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>
