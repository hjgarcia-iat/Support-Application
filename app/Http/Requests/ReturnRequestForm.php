<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ReturnRequestForm
 * @package App\Http\Requests
 */
class ReturnRequestForm extends FormRequest
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
            'name'           => 'required',
            'email'          => 'required|email',
            'district'       => 'required',
            'order_number'   => 'required',
            'reason'         => 'required',
            'products'       => 'required',
            'products.*.sku' => 'required',
            'products.*.quantity' => 'required|integer',
        ];
    }
}
