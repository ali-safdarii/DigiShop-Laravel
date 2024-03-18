<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CartApiRequest extends FormRequest
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
        // Common rules for both create and updateCartItem
        $commonRules = [
            'product_id' => 'required|exists:products,id',
            'color_id' => 'required|exists:colors,id',
        ];


        // Different rules for updateCartItem
        if ($this->isMethod('patch')) {
            return array_merge($commonRules, [
                'qty' => 'required|integer|min:1',
            ]);
        }

        // Default rules for create
        return array_merge($commonRules, [
            'qty' => 'integer|min:1',
        ]);
    }

    public function messages()
    {
        return [
            'product_id.required' => 'Product ID is required.',
            'color_id.required' => 'Color ID is required.',
            'product_id.exists' => 'Invalid product ID.',
            'color_id.exists' => 'Invalid color ID.',
            'qty.integer' => 'Quantity must be an integer.',
            'qty.min' => 'Quantity must be at least 1.',
        ];
    }

}
