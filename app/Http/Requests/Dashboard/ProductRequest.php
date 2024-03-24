<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [
                        'id' => 'required|exists:products,id',
                    ];
                }

            case 'POST': {
                    return [
                        'name' => 'required|string',
                        'image' => 'required|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                        'description' => 'required|string',
                        'price' => 'nullable|numeric',
                        'category_id' => 'required|numeric|exists:categories,id',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'discount_price' => 'nullable|numeric',
                        'colors' => 'nullable|array',
                        'colors.*' => 'nullable|string',
                        'sizes' => 'nullable|array',
                        'sizes.*' => 'nullable|string',
                        'images' => 'nullable|array',
                        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'quantity' => 'nullable|numeric'

                    ];
                }

            case 'PUT': {
                    return [
                        'name' => 'string',
                        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                        'description' => 'string',
                        'price' => 'nullable|numeric',
                        'category_id' => 'numeric|exists:categories,id',
                        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'discount_price' => 'nullable|numeric',
                        'colors' => 'nullable|array',
                        'colors.*' => 'nullable|string',
                        'sizes' => 'nullable|array',
                        'sizes.*' => 'nullable|string',
                        'images' => 'nullable|array',
                        'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                        'quantity' => 'nullable|numeric'

                    ];
                }
        }
    }
}
