<?php

namespace App\Http\Requests\ClientRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientRequest extends FormRequest
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
            'name'   => ['required','string','max:255','regex:/^[A-Za-z\s]+$/'],
            'email'  => 'required|email|unique:clients,email',
            'phone'  => 'required|string|min:10|max:15',
            'gstin'  => 'nullable|alpha_num|size:15',
            'city'   => 'required|string',
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ];
    }
}
