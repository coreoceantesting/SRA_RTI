<?php

namespace App\Http\Requests\SecondAppeal;

use Illuminate\Foundation\Http\FormRequest;

class StoreSecondAppealRequest extends FormRequest
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
            'file_no' => 'required',
            'who_came_from' => 'required',
            'subject' => 'required',
            'old_document' => 'required',
            'to_whom_it_was_entrusted' => 'required',
            'who_was_presented' => 'required',
            'who_was_sent' => 'required',
            'final_disposal' => 'required',
        ];
    }
}
