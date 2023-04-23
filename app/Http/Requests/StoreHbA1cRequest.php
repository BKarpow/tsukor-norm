<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreHbA1cRequest extends FormRequest
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
            'percentage' => 'required|numeric|max:100|min:1',
            'note' => 'max:250',
            'created_at' => 'required|date_format:Y-m-d H:i:s'
        ];
    }
}
