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
    <x-auth-session-status class="mb-4 rounded-lg border border-green-500/20 bg-green-500/10 px-4 py-3 text-green-300" :status="session('status')" />

    <form wire:submit="login" class="space-y-6">
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-300" />
            <x-text-input wire:model="form.email" id="email" class="mt-2 block w-full border-gray-700 bg-gray-800 text-gray-100 placeholder:text-gray-500 focus:border-purple-500 focus:ring-purple-500" type="email" name="email" required autofocus autocomplete="username" placeholder="you@example.com" />
            <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-300" />
            <x-text-input wire:model="form.password" id="password" class="mt-2 block w-full border-gray-700 bg-gray-800 text-gray-100 focus:border-purple-500 focus:ring-purple-500" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between gap-4">
            <label for="remember" class="inline-flex items-center text-sm text-gray-400">
                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-700 bg-gray-800 text-purple-600 shadow-sm focus:ring-purple-500 focus:ring-offset-gray-900" name="remember">
                <span class="ms-2">{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-purple-400 hover:text-purple-300" href="{{ route('password.request') }}" wire:navigate>
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-primary-button class="w-full justify-center rounded-lg bg-gradient-to-r from-purple-600 to-indigo-600 px-4 py-3 text-sm font-semibold normal-case tracking-normal text-white hover:from-purple-700 hover:to-indigo-700 focus:ring-purple-500 focus:ring-offset-gray-900 dark:bg-none dark:text-white dark:hover:bg-none dark:focus:bg-none dark:active:bg-none">
            {{ __('Log in') }}
        </x-primary-button>
    </form>
</div>
