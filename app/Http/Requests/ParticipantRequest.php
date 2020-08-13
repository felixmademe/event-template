<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParticipantRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|alpha_num',
            'birth_date' => 'required|date|date_format:Y-m-d',
            'event_id' => 'required|numeric',
            'recaptcha' => 'required'
        ];
    }
}
