<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});


Route::get('/', [RecipeController::class, 'index'])->name('recipe.index');
Route::get('nueva-receta', [RecipeController::class, 'create'])->name('recipe.create');
Route::post('agregar-receta', [RecipeController::class, 'store'])->name('recipe.store');
Route::get('receta/{recipe}', [RecipeController::class, 'show'])->name('recipe.show');
Route::get('gestion', [RecipeController::class, 'manage'])->name('recipe.manage');