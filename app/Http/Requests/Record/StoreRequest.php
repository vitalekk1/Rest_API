<?php

namespace App\Http\Requests\Record;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'fio' => 'required|string',
            'company' => 'nullable|string',
            'phone' => 'required|string|unique:records,phone',
            'email' => 'required|string',
            'date_of_birth' => 'nullable|date',
            'photo' => 'nullable|file',
        ];
    }
}
