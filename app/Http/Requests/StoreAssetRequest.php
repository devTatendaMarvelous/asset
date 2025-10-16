<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssetRequest extends FormRequest
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
            'brand' => 'required|string|max:255',
            'description' => 'nullable|string',
            'serial_number' => 'required|numeric|unique:assets,serial_number',
            'type_id' => 'required|exists:asset_types,id',
            'status' => 'nullable|in:ASSIGNED,STOLEN,LOST',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
