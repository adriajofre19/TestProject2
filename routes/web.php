<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\ContentController;
use App\Http\Middleware\EnsureIsAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
}); */

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    

    Route::post('/notes/afegir', [HomeController::class, 'create'])->name('notes.create');

    Route::get('/notes', [NotesController::class, 'index'])->name('notes.index');

    Route::get('/', function () {
        return Inertia::render('Home');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::get('/cursos', [CoursesController::class, 'index'])->name('cursos.index');

    Route::get('/courses/{id}', [CoursesController::class, 'show'])->name('courses.show');
    Route::post('/updateCurse/{id}',[CoursesController::class, 'update'])->name('curse.update');
    Route::post('/deleteCurse/{id}',[CoursesController::class, 'destroy'])->name('curse.destroy');

    Route::get('/contents', [ContentController::class, 'index'])->name('contents.index');

    Route::middleware(EnsureIsAdmin::class)->group(function () {
        Route::get('/adminusers', [AdminPanelController::class, 'index'])->name('admin.users');
        Route::post('/lista-usuaris/{id}', [AdminPanelController::class, 'update'])->name('users.update');
        Route::post('/deleteUser/{id}', [AdminPanelController::class, 'destroy'])->name('users.destroy');
    });
});

Route::get('/', [HomeController::class, 'index'])->name('home');




Route::get('/getAllUsers', function () {
    $users = User::all();
    return response()->json($users);
});


require __DIR__.'/auth.php';
