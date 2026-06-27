<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard.index', absolute: false), navigate: true);
    }
}; ?>

<div>
    <div class="mb-8 text-center">
        <p class="text-sm font-medium uppercase tracking-[0.22em] text-purple-400/80">Secure access</p>
        <h1 class="mt-3 text-3xl font-bold text-white">Welcome back</h1>
        <p class="mt-3 text-sm leading-6 text-gray-400">Sign in to update your portfolio content and manage inbound messages.</p>
    </div>

    <x-auth-session-status class="mb-5 rounded-2xl border border-green-500/20 bg-green-500/10 px-4 py-3 text-sm text-green-300" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <div>
            <x-input-label for="email" :value="__('Email address')" class="text-sm font-medium text-gray-300" />
            <x-text-input wire:model="form.email" id="email" class="mt-2 block w-full rounded-xl border border-white/10 bg-gray-800/80 px-4 py-3 text-gray-100 placeholder:text-gray-500 focus:border-purple-500 focus:ring-purple-500" type="email" name="email" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div>
            <div class="flex items-center justify-between gap-4">
                <x-input-label for="password" :value="__('Password')" class="text-sm font-medium text-gray-300" />

                @if (Route::has('password.request'))
                    <a class="text-sm text-purple-400 hover:text-purple-300" href="{{ route('password.request') }}" wire:navigate>
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <x-text-input wire:model="form.password" id="password" class="mt-2 block w-full rounded-xl border border-white/10 bg-gray-800/80 px-4 py-3 text-gray-100 focus:border-purple-500 focus:ring-purple-500" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <label for="remember" class="flex items-center gap-3 rounded-2xl border border-white/8 bg-gray-800/50 px-4 py-3 text-sm text-gray-300">
            <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-600 bg-gray-900 text-purple-600 shadow-sm focus:ring-purple-500 focus:ring-offset-gray-900" name="remember">
            <span>{{ __('Keep me signed in on this device') }}</span>
        </label>

        <x-primary-button class="w-full justify-center border-0 rounded-lg bg-purple-600 px-6 py-3 text-sm font-semibold normal-case tracking-normal text-white hover:bg-purple-700 focus:ring-purple-500 focus:ring-offset-gray-950">
            {{ __('Sign in to dashboard') }}
        </x-primary-button>
    </form>
</div>
