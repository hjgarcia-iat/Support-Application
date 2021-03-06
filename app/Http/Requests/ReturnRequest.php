<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ReturnRequest
 * @package App\Http\Requests
 */
class ReturnRequest extends FormRequest
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
            'name'                => 'required',
            'email'               => 'required|email',
            'district'            => 'required',
            'order_number'        => 'required',
            'rma_number'          => 'required',
            'reason'              => 'required',
            'products'            => 'required',
            'products.*.sku'      => 'required',
            'products.*.quantity' => 'required|integer',
        ];
    }
}
