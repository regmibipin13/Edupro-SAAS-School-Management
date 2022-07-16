<?php

namespace App\Http\Requests\Students;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'name' => ['required'],
            'email' => ['required', 'unique:users,email,' . $this->student->id],
            'phone' => ['required', 'unique:users,phone,' . $this->student->id],
            'gender' => ['required'],
            'city' => ['required'],
            'address' => ['required'],
            'dob' => ['required'],
            'admitted_date' => ['required'],
            'classroom_id' => ['required'],
            'section_id' => ['required'],
            'parent_id' => ['required'],
            'blood_group' => ['required'],
        ];
    }
    public function messages()
    {
        return [
            'classroom_id.required' => 'Classroom is required',
            'section_id.required' => 'Section is required',
            'parent_id.required' => 'Parent is required',
        ];
    }
}
