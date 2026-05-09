<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePresencaRequest extends FormRequest
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
            'user_id' => 'required|integer|exists:users,id',
            'status' => 'required|string|max:15',
            'justificada' => 'boolean',
            'entrada' => 'required|date_format:H:i',
            'entrada' => 'required|date_format:H:i',
            'justificativa' => 'nullable|string|max:255',
            'liquidado' => 'boolean'
        ];
    }
}
