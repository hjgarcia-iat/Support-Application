<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NextGenPetRequest extends FormRequest
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
            'institution_name' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'po_number' => 'required',
            'inquiry' => 'required',
            'comment' => 'required_if:inquiry,Other,Order Cancellation,Order Modification',
        ];
    }
}
