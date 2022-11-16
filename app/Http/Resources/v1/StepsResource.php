<?php

namespace App\Http\Resources\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class StepsResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'recipe_id'           => $this->recipe_id,
            'step'                => $this->step,
            // 'created_at'          => $this->created_at,
            // 'updated_at'          => $this->updated_at,
        ];
    }
}
