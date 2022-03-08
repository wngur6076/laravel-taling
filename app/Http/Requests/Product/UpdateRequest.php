<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'display_name' => ['required', 'string', 'max:100'],
            'description' => ['required', 'string'],
            'price' => ['required', 'integer'],
            'sale_price' => ['required', 'integer'],
            'thumb_img' => ['nullable', 'image'],
            'category_id' => ['required', 'integer'],
            'market_id' => ['required', 'integer'],
        ];
    }
}
