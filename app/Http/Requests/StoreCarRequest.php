<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreCarRequest extends FormRequest
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
            
            "maker_id" => "required|integer|min:1",
            "model_id" => "required|integer|min:1",
            "year" => "required|integer|between:1800,2100",
            "price" => "required|integer|min:0",
            "vin" => "required|string|size:17|regex:/^[A-HJ-NPR-Z0-9]{17}$/",
            "mileage" => "required|integer|min:0",
            "fuel_type_id" => "required|integer|min:1",
            "car_type_id" => "required|integer|min:1",
            "user_id" => "required|integer|min:1",
            "city_id" => "required|integer|min:1",
            "address" => "required|string|max:255",
            "phone" => "required|string|between:4,45",
            "description" => "string|max:4000"

        ];
    }
}
