<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FastStoreEstateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'raw_text' => 'nullable|string',
            'watermark' => 'nullable|boolean',
            'photos' => 'nullable|array',
            'photos.*' => 'nullable',
        ];
    }
}
