<?php

namespace App\Http\Requests;

use App\Enums\ServiceStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ServiceStatusUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in([ServiceStatus::APPROVED->value])]
        ];
    }
}
