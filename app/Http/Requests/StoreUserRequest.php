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

        $rules =  [
            'first_name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'middle_name' => ['sometimes','required','string', 'max:255'],
            "role" => ['required', 'string'],
        ];

        if($this->method() === "PUT"){

            $rules += [
                'phone' => ['required', 'string','max:11'],
                'email' => ['required', 'string', 'email', 'max:255',],
                // Check here again
                // 'password' => ['string', 'min:8',]
            ];
            return $rules;
        }
        //Post Request
        $rules += [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string','max:11', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];

        return $rules;
    }
}
