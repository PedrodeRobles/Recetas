<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $recipes = Recipe::where('name', 'LIKE', "%$request->q%")
                ->orderBy('id', 'DESC')
                ->get();

        return Inertia::render('Recipe/Index', ['recipes' => $recipes]);
    }

    public function create()
    {
        return Inertia::render('Recipe/Create');
    }

    public function store(RecipeRequest $request)
    {
        Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'portions' => $request->portions,
            'image' => $request->image,
        ]);

        $lastRecipe = Recipe::select('id')->orderBy('id', 'desc')->first();

        /*Cycle through ingredients and save them*/
        foreach ($request->ingredients as $index => $data) {
            Ingredient::create(
                ['recipe_id' => $lastRecipe->id] 
                +
                $request->ingredients[$index]
            );
        }

        /*Cycle through steps and save them*/
        foreach ($request->steps as $index => $data) {
            Step::create(
                ['recipe_id' => $lastRecipe->id] 
                +
                $request->steps[$index]
            );
        }

        // $mesagge = "Guardadoooo";

        // return $mesagge;
    }

    public function show(Recipe $recipe)
    {
        // $recipe->load('ingredients', 'steps');
        // dd($recipe->ingredients[0]);

        return Inertia::render('Recipe/Show', [
            'recipe' => $recipe->load('ingredients', 'steps')
        ]);
    }

    public function manage(Request $request)
    {
        // $recipes = Recipe::latest()->get();

        $recipes = Recipe::where('name', 'LIKE', "%$request->q%")
                ->orWhere('description', 'LIKE', "%$request->q%")
                ->orderBy('id', 'DESC')
                ->get();

        return Inertia::render('Recipe/Manage', ['recipes' => $recipes]);
    }

    public function edit(Recipe $recipe)
    {
        
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
