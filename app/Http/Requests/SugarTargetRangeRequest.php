<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SugarTargetRangeRequest extends FormRequest
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
            'min_glu' => 'required|numeric|min:3',
            'max_glu' => 'required|numeric|max:15',
        ];
    }
}
