<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AmbulanceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'car_number'=>"required",
            'car_model'=>"required",
            'car_year_made'=>"required",
            'driver_license_number'=>"required",
            'driver_phone'=>"required",
            'car_type'=>"required|in:0,1",
            'driver_name'=>"required|unique:ambulances,driver_name,".$this->id,
            'notes'=>"nullable",


        ];
    }
}
