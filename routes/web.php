<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::post('/notes/afegir', [HomeController::class, 'create'])->name('notes.create');

    Route::middleware(EnsureIsAdmin::class)->group(function () {
        Route::get('/adminusers', [AdminPanelController::class, 'index'])->name('admin.users');
        Route::post('/lista-usuaris/{id}', [AdminPanelController::class, 'update'])->name('users.update');
        Route::post('/deleteUser/{id}', [AdminPanelController::class, 'destroy'])->name('users.destroy');
    });
});


Route::get('/getAllUsers', function () {
    $users = User::all();
    return response()->json($users);
});


require __DIR__.'/auth.php';
