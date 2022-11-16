<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'portions'    => $this->portions,
            'image'       => $this->image,
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
            'ingredients' => IngredientsResource::collection($this->ingredients),
            'steps'       => StepsResource::collection($this->steps)
        ];
    }
}