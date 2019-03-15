<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'mobile' => ['required', Rule::unique('customer')->ignore($this->segment(3))],
            'fax' => '',
            // 'address' => 'required',
            'email'    => ['nullable','email', 'max:191',  Rule::unique('users')->ignore($this->user_id)],
            'timezone' => 'required|max:191'
        ];
    }

    public function messages()
    {
        return [
            'valid_phone_number' => 'Invalid Mobile No. or Not Support Mobile No.'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('edit customer');
    }
}
