<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBloodPressureRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'sis' => 'required|numeric|max:300|min:30',
            'dis' => 'required|numeric|max:295|min:1',
            'pulse' => 'required|numeric|max:300|min:25',
            'note' => 'max:250',
        ];
    }
}
