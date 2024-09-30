<?php

namespace App\Http\Requests\FirstAppeal;

use Illuminate\Foundation\Http\FormRequest;

class StoreFirstAppealRequest extends FormRequest
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
            'applicant_name' => 'required',
            'received_date' => 'required',
            'mobile_no' => 'required|digits:10',
            'date' => 'required',
            'subject' => 'required',
            'concerned_department' => 'required',
            'name_of_concerned_officer' => 'nullable',
        ];
    }
}
