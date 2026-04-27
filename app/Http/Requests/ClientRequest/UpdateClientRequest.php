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
            'name'   =>['required','string','max:255','regex:/^[A-Za-z\s]+$/'],
            'email'  => [
                'required',
                'email',
                // Ignore the current user's ID during the unique check
                Rule::unique('clients', 'email')->ignore($clientId),
            ],
            'phone'  => 'required|string|min:10|max:15',
            'gstin'  => ['nullable','size:15','regex:/^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$/'],
            'city'   => 'required|string',
            'status' => ['required', Rule::in(['Active', 'Inactive'])],
        ];
    }
}
