<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssetRequest extends FormRequest
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
        return  [
        'brand' => 'required|string|max:255',
        'description' => 'nullable|string',
        'serial_number' => 'required',
        'type_id' => 'required|exists:asset_types,id',
        'status' => 'nullable|in:ASSIGNED,RESERVED,LOST,DAMAGED,RETIRED,DISPOSED',
        'user_id' => 'required|exists:users,id'
    ];
    }
}
