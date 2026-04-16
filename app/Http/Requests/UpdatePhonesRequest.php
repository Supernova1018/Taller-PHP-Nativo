<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhonesRequest extends FormRequest
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
            "phone_band" => ['required', 'max:255'],
                "phone_model" => ['required', 'max:255'],
                "phone_price" => ['required', 'numeric', 'min:1'],
                "phone_display_size" => ['required', 'integer', 'min:1'],
                "phone_is_smartphone" => ['required', 'boolean'],
                "id_categoria" => ['required', 'exists:categorias,id_categoria'],
                "codigo_barras" => ['required', 'string', 'max:50']
        ];
    }
}
