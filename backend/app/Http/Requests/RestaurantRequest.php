<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestaurantRequest extends FormRequest
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
            // "user_id" => ["required"],
            "name" => ["required", "min:2", "max:100"],
            "description" => ["max:255"],
            "city" => ["required", "min:2", "max:100"],
            "address" => ["required", "min:2", "max:255"],
            "img" => ["required", "min:2", "max:255"],
            "telephone" => ["required", "min:2", "max:100"],
            "website" => ["required", "min:2", "max:100"],
            "category_id" => ["nullable", "exists:categories,id"]
        ];
    }
}
