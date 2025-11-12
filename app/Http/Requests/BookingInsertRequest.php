<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BookingInsertRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            "service_id" => "exists:services,id",
            "service_offering_id" => "exists:service_offerings,id",
            "start_at" => "required",
            "end_at" => "required",
        ];
    }
}
