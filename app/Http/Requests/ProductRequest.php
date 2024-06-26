<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $validationRules = [
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'attributes.*' => 'nullable',
        ];
        if ($this->product) {
            // Validation rule for nullable on update
        }

        return $validationRules;
    }
}
