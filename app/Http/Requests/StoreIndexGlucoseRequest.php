<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ReCaptcha;

class StoreIndexGlucoseRequest extends FormRequest
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
            'description_food' => 'max:250',
            'g-recaptcha-response' => ['required', new ReCaptcha],
        ];
    }
}
