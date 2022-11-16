<?php

use App\Http\Controllers\v1\RecipeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('recetas', [RecipeController::class, 'index']);
Route::get('recetas/{recipe}', [RecipeController::class, 'show']);
