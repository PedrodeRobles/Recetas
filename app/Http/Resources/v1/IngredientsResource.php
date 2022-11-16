<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class IngredientsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'recipe_id'           => $this->recipe_id,
            'ingredient'          => $this->ingredient,
            'amount'              => $this->amount,
            'unit_of_measurement' => $this->unit_of_measurement,
            // 'created_at'          => $this->created_at,
            // 'updated_at'          => $this->updated_at,
        ];
    }
}
