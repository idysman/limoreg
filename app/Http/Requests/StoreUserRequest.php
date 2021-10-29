<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'middle_name' => ['sometimes','required','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            "role" => ['required', 'string'],
            'phone' => ['required', 'string','max:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
