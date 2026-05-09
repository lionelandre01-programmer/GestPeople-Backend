<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalaryRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'salario' => 'required|numeric',
            'transporte' => 'required|numeric|max:100',
            'alimentacao' => 'required|numeric|max:100',
            'desempenho' => 'required|numeric|max:100',
            'presenca' => 'required|numeric|max:100'
        ];
    }
}
