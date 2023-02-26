<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateIndexGlucoseRequest extends FormRequest
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
            'food' => 'required|string|max:100|min:2',
            'ig' => 'required|numeric|max:120',
            'one_ho_count' => 'required|numeric|min:1',
            'one_ho_unit' => 'required|string|max:20|min:1',
        ];
    }
}
