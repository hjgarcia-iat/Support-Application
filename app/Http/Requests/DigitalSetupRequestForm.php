<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DigitalSetupRequestForm extends FormRequest
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
            'name'         => 'required',
            'email'         => 'required|email',
            'po_number'         => 'required',
            'district'          => 'required',
            'start_date'        => 'required',
            'curriculum'        => 'required',
            'district_manager'  => 'required',
            'dm_name'           => 'required_if:district_manager,yes',
            'dm_email'          => 'required_if:district_manager,yes|sometimes|nullable|email',
            'teachers'          => 'required_if:district_manager,no',
            'teachers.*.name'   => 'required_if:district_manager,no',
            'teachers.*.email'  => 'required_if:district_manager,no|email',
            'teachers.*.school' => 'required_if:district_manager,no',
        ];
    }
}
