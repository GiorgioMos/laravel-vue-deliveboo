<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

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
            "name" => ["required", "min:2", "max:100"],
            "description" => ["max:255"],
            "city" => ["required", "min:2", "max:100"],
            "address" => ["required", "min:2", "max:255"],
            "img" => ["", File::image()->min("1kb")->max("20mb")], //todo rimossa img required, è protetta da validazione client ma sarebbe meglio separare le request per store e upload
            "telephone" => ["required", "min:2", "max:100"],
            "website" => ["required", "min:2", "max:100"],
            "categories" => ["exists:categories,id"],
        ];
    }
}
