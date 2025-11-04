<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchServiceRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'city' => 'nullable|string',
            'service_type' => 'nullable|string',
        ];
    }
}
