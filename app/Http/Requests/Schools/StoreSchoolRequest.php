<?php

namespace App\Http\Requests\Schools;

use Illuminate\Foundation\Http\FormRequest;

class StoreSchoolRequest extends FormRequest
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
            'name' => ['required', 'unique:schools'],
            'nickname' => ['required', 'unique:schools'],
            'email' => ['required', 'unique:schools'],
            'contact' => ['required', 'unique:schools', 'min:10', 'max:10'],
            'city' => ['required'],
            'address' => ['required'],
            'owner_name' => ['nullable'],
            'owner_contact' => ['nullable', 'unique:schools', 'min:10', 'max:10'],
            'principle_name' => ['required'],
            'principle_contact' => ['nullable', 'unique:schools', 'min:10', 'max:10'],
            'google_map_link' => ['nullable'],
            'is_active' => ['nullable'],

        ];
    }
}
