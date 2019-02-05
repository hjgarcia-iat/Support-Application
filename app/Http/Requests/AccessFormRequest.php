<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class AccessFormRequest
 * @package App\Http\Requests
 */
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

        $rules = $this->validateAccessType($this->get('resource'), $rules);

        $rules = $this->validateEbookList($this->get('resource'), $rules);

        $rules = $this->validateVersion($this->get('resource'), $rules);

        return $rules;
    }

    /**
     * @param $resource
     * @param array $rules
     * @return array
     */
    protected function validateAccessType($resource, array $rules)
    {
        if (!empty($resource) and in_array('Active Physics-Active Chemistry PD', $resource)) {
            $rules['access_type'] = 'required';
        }

        if (!empty($resource) and in_array('IMP/MM Cyberpd', $resource)) {
            $rules['access_type'] = 'required';
        }

        return $rules;
    }

    /**
     * @param $resource
     * @param array $rules
     * @return array
     */
    protected function validateEbookList($resource, array $rules)
    {
        if (!empty($resource) and in_array('Ebook', $resource)) {
            $rules['ebook_list'] = 'required';
        }
        return $rules;
    }

    /**
     * @param $resource
     * @param array $rules
     * @return array
     */
    protected function validateVersion($resource, array $rules)
    {
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
