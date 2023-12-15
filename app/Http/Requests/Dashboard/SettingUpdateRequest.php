<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class SettingUpdateRequest extends FormRequest
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
            'name'=>'string|nullable',
            'description'=>'string|nullable',
            'logo'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'favicon'=>'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'email'=>'email|nullable',
            'phone'=>'string|nullable',
            'address'=>'string|nullable',
            'facebook'=>'string|nullable',
            'twitter'=>'string|nullable',
            'instagram'=>'string|nullable',
            'youtube'=>'string|nullable',
            'tiktok'=>'string|nullable',
        



        ];
    }
}
