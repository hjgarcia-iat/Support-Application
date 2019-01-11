<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccessFormRequest extends FormRequest
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
        $rules = [
            'sales_rep' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email'],
            'district' => ['required'],
            'resource' => ['required'],
            'time_frame' => ['required'],
            'zip_code' => ['required', 'exists:zipcodes,zip_code'],
        ];

        $resource = $this->get('resource');

        if (!empty($resource) and in_array('Ebook', $resource)) {
            $rules['ebook_list'] = 'required';
        }

        if (!empty($resource) and in_array('IQWST Demo Portal', $resource)) {
            $rules['version'] = 'required';
        }

        if (!empty($resource) and in_array('California Demo Portal', $resource)) {
            $rules['version'] = 'required';
        }

        if (!empty($resource) and in_array('IQWST IDE Demo', $resource)) {
            $rules['version'] = 'required';
        }

        if (!empty($resource) and in_array('IQWST IDE Demo - Spanish', $resource)) {
            $rules['version'] = 'required';
        }

        return $rules;
    }
}
