<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::latest()->get();

        return Inertia::render('Recipe/Index', ['recipes' => $recipes]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Recipe $recipe)
    {
        //
    }

    public function edit(Recipe $recipe)
    {
        //
    }

    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    public function destroy(Recipe $recipe)
    {
        //
    }
}
