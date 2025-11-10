<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'room_id' => ['integer', 'exists:rooms,id'],
            'description' => ['string', 'max:255'],
            'start_at' => ['date', 'before:end_at'],
            'end_at' => ['date', 'after:start_at']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
