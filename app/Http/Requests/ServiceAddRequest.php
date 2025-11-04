<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceAddRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'=>'required|string|max:64',
            'city' => 'required|string|max:64',
            'description' => 'required|string'
        ];
    }
}
