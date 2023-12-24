<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                        'id' => 'required|exists:categories,id',
                    ];
                }

            case 'POST': {
                    return [
                        'name' => 'required|unique:categories,name',
                        'parent_id' => 'nullable|exists:categories,id',
                        'image' => 'required|nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',

                    ];
                }

            case 'PUT': {
                    return [
                        'name' => 'string',
                        'parent_id' => 'nullable|exists:categories,id',
                        'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                    ];
                }
        }
    }
}
