<?php

namespace App\Http\Requests;

class CustomerRequest extends ApiValidationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|min:3|max:25',
            'last_name'=>'required|min:3|max:25',
            'mac'=>'required|mac_address|unique:App\Models\Customer,mac',
            'phone'=>'required|min:7|max:12',
            'locked'=>'prohibited',
            'start_date'=>'required|date_format:Y-m-d',
            'plan'=>'required|in:15D,30D',
            'expiration_date'=>'prohibited',
            'amount'=>'required|decimal:0,2'
        ];
    }


    // protected function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(
    //         response($validator->errors(), 422));

  
    // }
}
