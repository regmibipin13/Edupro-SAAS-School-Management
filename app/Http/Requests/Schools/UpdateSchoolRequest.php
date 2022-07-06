<?php

namespace App\Http\Requests\Schools;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
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
            'name' => ['required', 'unique:schools,name,' . $this->school->id],
            'nickname' => ['required', 'unique:schools,nickname,' . $this->school->id],
            'email' => ['required', 'unique:schools,email,' . $this->school->id],
            'contact' => ['required', 'unique:schools,contact,' . $this->school->id],
            'city' => ['required'],
            'address' => ['required'],
            'owner_name' => ['nullable'],
            'owner_contact' => ['nullable', 'unique:schools,owner_contact,' . $this->school->id],
            'principle_name' => ['required'],
            'principle_contact' => ['nullable', 'unique:schools,principle_contact,' . $this->school->id],
            'google_map_link' => ['nullable'],
            'is_active' => ['nullable'],

        ];
    }
}
