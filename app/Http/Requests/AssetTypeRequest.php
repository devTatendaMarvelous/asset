<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AssetTypeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $assetTypeId = $this->route('asset_type') ?: $this->route('id');

        return [
            'name' => [
                'required',
                'string',
                'max:191',
                Rule::unique('asset_types')->ignore($assetTypeId),
            ],
            'description' => ['nullable', 'string'],
        ];
    }
}
