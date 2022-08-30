<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Recipe;

class Ingredient extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'ingredient',
        'amount',
        'unit_of_measurement'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
