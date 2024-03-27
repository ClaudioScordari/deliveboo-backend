<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRestaurantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'activity_name' => 'required|max:255', 
            'VAT_number' => 'required|max:50', 
            'address' => 'required|max:255', 
            'img' => 'nullable|image',
            'description' => 'nullable|max:4096',
            'types' => 'nullable|array|exists:types,id',
            'remove_file' => 'nullable|boolean',
        ];
    }
}
