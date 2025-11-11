<?php

namespace App\Http\Requests;

use App\Enums\BookingStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class BookingStatusUpdate extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => ['required', new Enum(BookingStatus::class)],
        ];
    }
}
