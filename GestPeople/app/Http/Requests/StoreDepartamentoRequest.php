<?php

namespace App\Http\Requests;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDepartamentoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check() || User::count() === 0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'denominacao' => 'required|string|unique:departamentos,denominacao|max:255',
            'responsabilidade' => 'required|string|min:5|max:255',
        ];
    }
}
