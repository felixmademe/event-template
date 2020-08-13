<?php

namespace App\Http\Requests;

use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use Illuminate\Validation\Rule;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::first();
        if( $user->id === Auth::user()->id )
        {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'start_time' => 'nullable|date|date_format:Y-m-d H:i',
            'description' => 'nullable|string',
            'public' => 'boolean',
            'registration' => 'boolean',
            'max_visitors' => 'required|numeric',
            'image_banner' => 'nullable|string',
            'price' => 'required|integer',
            'swish' => 'nullable|string'
        ];
    }
}
