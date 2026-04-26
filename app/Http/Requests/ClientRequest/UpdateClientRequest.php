<?php

namespace App\Http\Requests\ClientRequest;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientRequest extends FormRequest
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
        $clientId = $this->route('client')->id;

        return [
            'name'   => 'required|string|max:255',
            'email'  => [
                'required',
                'email',
                // Ignore the current user's ID during the unique check
                Rule::unique('clients', 'email')->ignore($clientId),
            ],
            'phone'  => 'required|string|min:10|max:15',
            'gstin'  => 'nullable|alpha_num|size:15',
            'city'   => 'required|string',
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ];
    }
}
