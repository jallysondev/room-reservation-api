<?php

namespace App\Http\Requests\Reservation;

use Illuminate\Foundation\Http\FormRequest;

class CreateReservationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'room_id' => ['required', 'integer', 'exists:rooms,id'],
            'description' => ['nullable', 'string', 'max:255'],
            'start_at' => ['required', 'date', 'before:end_at'],
            'end_at' => ['required', 'date', 'after:start_at']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
