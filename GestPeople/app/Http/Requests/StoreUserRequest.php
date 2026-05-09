<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StoreUserRequest extends FormRequest
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email',
            'nascimento' => 'required|date|before:today',
            'genero' => 'required|string',
            'departamento_id' => 'required|integer|exists:departamentos,id',
            'funcao_id' => 'required|integer|exists:funcaos,id',
            'phone' => 'nullable|string|max:12',
            'password' => 'nullable|string|min:6',
            'morada' => 'nullable|string|max:255',
            'bi' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }
}
