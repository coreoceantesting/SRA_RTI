<?php

namespace App\Http\Requests\Admin\RTI;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRtiRequest extends FormRequest
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
            'applicant_name' => 'required|regex:/^[\p{L} ]+$/u',
            'received_date' => 'required',
            'date' => 'required',
            'subject' => 'required',
            'concerned_department' => 'required',
            'name_of_concerned_officer' => 'nullable',
        ];
    }
}
