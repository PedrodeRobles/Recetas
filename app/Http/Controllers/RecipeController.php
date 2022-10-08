<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Recipe;
use App\Models\Ingredient;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Undefined;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Recipe/Index', [
            'recipes' => Recipe::where('name', 'LIKE', "%$request->q%")
                ->orderBy('id', 'DESC')
                ->get()
                ->map(function ($recipe) {
                    return [
                        'id' => $recipe->id,
                        'name' => $recipe->name,
                        'description' => $recipe->description,
                        'image' => asset('storage/' . $recipe->image),
                    ];
                }),
        ]);
    }

    public function create()
    {
        return Inertia::render('Recipe/Create');
    }

    public function store(RecipeRequest $request)
    {
        /*Change image dimension*/
        $path= $request->file('image');
            // Resize and encode to required type
        $img = Image::make($path)->resize(200, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode();
            //Provide the file name with extension 
        $filename = time(). '.' .$path->getClientOriginalExtension();
        //Put file with own name
        Storage::put($filename, $img);
        //Move file to your location 
        Storage::move($filename, 'public/recipes/images/' . $filename);
        /*-----*/


        Recipe::create([
            'name' => $request->name,
            'description' => $request->description,
            'portions' => $request->portions,
            'image' => 'recipes/images/' . $filename,
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
    }

    public function show(Recipe $recipe)
    {
        // dd( Recipe::where('id', $recipe->id)->get());
        return Inertia::render('Recipe/Show', [
            'recipe' => Recipe::where('id', $recipe->id)->get()
                ->map(function ($recipe) {
                    return [
                        'id' => $recipe->id,
                        'name' => $recipe->name,
                        'description' => $recipe->description,
                        'portions' => $recipe->portions,
                        'image' => asset('storage/' . $recipe->image),
                        'ingredients' => Ingredient::where('recipe_id', $recipe->id)->get(),
                        'steps' => Step::where('recipe_id', $recipe->id)->get(),
                    ];
                }),
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
        return Inertia::render('Recipe/Edit', [
            'recipe' => $recipe->load('ingredients', 'steps'),
        ]);
    }

    public function update(Request $request, Recipe $recipe)
    {
        /*Cycle through ingredients and update them*/
        foreach ($request->ingredients as $index => $data) {
            
            /*if ingredient exists it is updated else it´s created*/
            if( isset($request->ingredients[$index]['id']) == true) {
                $recipe->ingredients[$index]->update([
                    'amount' => $request->ingredients[$index]['amount'],
                    'ingredient' => $request->ingredients[$index]['ingredient'],
                    'unit_of_measurement' => $request->ingredients[$index]['unit_of_measurement'],
                ]);
            } else {
                Ingredient::create(
                    ['recipe_id' => $recipe->id] 
                    +
                    $request->ingredients[$index]
                );
            }
        }

        /*Cycle through steps and update them*/
        foreach ($request->steps as $index => $data) {
            $recipe->steps[$index]->update([
                'step' => $request->steps[$index]['step'],
            ]);
        }

        /*Delete ingredient when select trash and save*/ 
        foreach ($request->ingredientIdDelete as $index => $data) {
            $ingrediente = Ingredient::find($data);
            $ingrediente->delete();
        }

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $recipe->image);
            
            /*Change image dimension*/
            $path= $request->file('image');
                // Resize and encode to required type
            $img = Image::make($path)->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->encode();
                //Provide the file name with extension 
            $filename = time(). '.' .$path->getClientOriginalExtension();
            //Put file with own name
            Storage::put($filename, $img);
            //Move file to your location 
            Storage::move($filename, 'public/recipes/images/' . $filename);
            /*-----*/

            $recipe->update([
                'name' => $request->name,
                'description' => $request->description,
                'portions' => $request->portions,
                'image' => 'recipes/images/' . $filename,
            ]);
        } else {
            $recipe->update( array_filter($request->all()) );
        }
    }

    public function destroy(Recipe $recipe)
    {
        $recipe->delete();
    }
}
