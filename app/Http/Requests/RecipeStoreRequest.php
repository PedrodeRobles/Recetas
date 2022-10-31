<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RecipeStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'        => 'required',
            'description' => 'required|max:500',
            'portions'    => 'required|numeric',
            'image'       => 'required|image',
            'ingredients' => 'required',
            'steps'       => 'required'
        ];
    }
}
