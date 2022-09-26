<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApppointmentStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'schedule_date' => 'required',
            'schedule_start_time' => 'required',
            'schedule_end_time' => 'required',
            'user_id' => 'required',
            'shop_id' => 'required'
        ];
    }
}
