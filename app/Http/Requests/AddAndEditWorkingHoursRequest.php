<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddAndEditWorkingHoursRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'working_hours'               => 'required|array',
            'working_hours.*.service_id'  => 'required|exists:services,id',
            'working_hours.*.day_of_week' => 'required|string',
            'working_hours.*.opens_at'    => 'nullable|integer|min:0|max:23',
            'working_hours.*.closes_at'   => 'nullable|integer|min:0|max:23|gt:working_hours.*.opens_at'
        ];
    }
}
