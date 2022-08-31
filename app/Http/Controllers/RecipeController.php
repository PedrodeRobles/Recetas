<?php

namespace App\Http\Controllers;

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

    public function store(Request $request)
    {
        Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'portions' => $request->portions,
            'image' => $request->image,
        ]);

        $lastRecipe = Recipe::select('id')->orderBy('id', 'desc')->first();

        for ($i=0; $i < 2; $i++) { 
            Ingredient::create([
                'recipe_id'  => $lastRecipe->id,
                'ingredient' => $request->ingredient,
                'amount' => $request->amount,
                'unit_of_measurement' => $request->unit_of_measurement,
            ]);
        }

        // dd($request->ingredients->ingredient);

        // $ingredient = [
        //     [
        //         'recipe_id'  => $lastRecipe->id,
        //         'ingredient' => $request->ingredients->ingredient,
        //         'amount' => $request->ingredients->amount,
        //         'unit_of_measurement' => $request->ingredients->unit_of_measurement,
        //     ],
        //     [
        //         'recipe_id'  => $lastRecipe->id,
        //         'ingredient' => $request->ingredients->ingredient2,
        //         'amount' => $request->ingredients->amount2,
        //         'unit_of_measurement' => $request->ingredients->unit_of_measurement2,
        //     ],  
        // ];

        // DB::table('ingredients')->insert($ingredient);

        return "guardado";
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
