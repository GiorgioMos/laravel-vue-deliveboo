<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class StoreOrderRequest extends FormRequest
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
            "total_price" => ["required", "min:2", "max:100"],
            "notes" => ["nullable", "max:255"],
            "guest_city" => ["required", "min:2", "max:100"],
            "guest_address" => ["required", "min:2", "max:255"],
            "guest_telephone" => ["required", "min:2", "max:100"],
            "guest_name" => ["required", "min:2", "max:100"],
            "guest_surname" => ["required", "min:2", "max:100"],
            "guest_email" => ["required", "min:2", "max:100"],
            "date" => ["required", "min:2", "max:100"],
            "products.*.id" => ["exists:products,id"], // Validazione per ogni id di prodotto
            "products.*.quantity" => ["required", "integer", "min:1"], // Validazione per ogni quantità di prodotto
        ];
    }
}
