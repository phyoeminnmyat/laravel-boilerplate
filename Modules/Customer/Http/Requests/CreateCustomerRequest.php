<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => 'required|max:191',
            // 'mobile' => 'required|valid_phone_number|unique_phone_number',
            'mobile' => ['required', Rule::unique('customer')],
            'fax' => '',
            'address' => 'nullable',
            'email'    => ['nullable','email', 'max:191', Rule::unique('users')],
            'timezone' => 'required|max:191',
            'password' => 'required|min:6|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'valid_phone_number' => 'Invalid Mobile No. or Not Support Mobile No.',
            'unique_phone_number' => 'This mobile number is already exit!',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create customer');
    }
}
