<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsulinTakeRequest extends FormRequest
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
            'insulin_id' => 'required|numeric|exists:insulins,id',
            'insulin_dose' => 'required|numeric',
            'note' => 'max:250',
            'created_at' => 'required|max:250|date_format:Y-m-d H:i:s',
        ];
    }
}
