<?php

namespace App\Http\Requests\Api\Element;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApiElementRequest extends FormRequest
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
            'title' => 'string',
            'article' => '',
            'brand' => 'string',
            'volume' => 'integer',
            'description' => 'string',
            'count' => 'integer',
            'price' => 'integer',
            'category_id' => 'integer'
        ];
    }
}
