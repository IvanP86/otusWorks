<?php

namespace App\Http\Requests\Element;

use Illuminate\Foundation\Http\FormRequest;

class StoreElementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string',
            'article' => 'required',
            'brand' => 'required|string',
            'volume' => 'required|integer',
            'description' => 'string',
            'count' => 'required|integer',
            'price' => 'required|integer',
            'category_id' => 'required|integer'
        ];
    }
}