<?php

use App\Livewire\Dashboard;
use App\Livewire\Projects;
use App\Livewire\Skills;
use App\Livewire\Experiences;
use App\Livewire\Messages;
use App\Livewire\Profile;
use App\Livewire\Account;
use App\Livewire\Actions\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::post('/logout', function (Request $request, Logout $logout) {
    $logout();

    return redirect()->route('home');
})->middleware('auth')->name('logout');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', Dashboard::class)->name('index');
    
    Route::get('/projects', Projects\Index::class)->name('projects.index');
    Route::get('/projects/create', Projects\Create::class)->name('projects.create');
    Route::get('/projects/{project}/edit', Projects\Edit::class)->name('projects.edit');
    
    Route::get('/skills', Skills\Index::class)->name('skills.index');
    
    Route::get('/experiences', Experiences\Index::class)->name('experiences.index');
    
    Route::get('/messages', Messages\Index::class)->name('messages.index');
    
    Route::get('/profile', Profile\Edit::class)->name('profile.edit');

    Route::get('/account', Account\Settings::class)->name('account.settings');
});

require __DIR__.'/auth.php';
