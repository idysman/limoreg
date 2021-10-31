<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVehicleRequest extends FormRequest
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
        
            'owner_fname' => ['required', 'string', 'max:255'],
            'owner_surname' => ['required', 'string', 'max:255'],
            'owner_email' => ['required', 'string', 'email', 'max:255'],
            'owner_phone' => ['required', 'string', 'max:11'],
            'owner_license_number' => ['required', 'string', 'max:255'],
            'engine_number' => ['required', 'string', 'max:255'],
            'chassis_number' => ['required', 'string', 'max:255'],
            'plate_number' => ['required', 'string', 'unique:vehicles'],
            'model' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string'],
            'vehicle_type'=> ['required', 'integer'],
            'policy_number'=> ['required', 'string', 'max:255'],
            'engine_capacity'=> ['required', 'string'],
            'tank_capacity'=> ['required', 'string'],
            'odometer'=> ['required', 'string'],
            'color'=> ['required', 'string'],
            'fuel_type'=> ['required', 'string'],
            'year_of_manufacture'=> ['required', 'integer'],
            'title'=> ['required', 'string'],
            'address'=> ['required', 'string'],
            'owner_identification'=> ['required','string', 'max:255'],
            'identification_no' => ['required', 'string', 'max:255'],
            'state'=> ['required', 'string'],
            'lga' => ['required', 'string'],
        ];
    }
}

