<?php

namespace App\Http\Requests;

class UpdateCustomerRequest extends ApiValidationRequest
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
            'mac'=>'required|mac_address',
            
        ];
    }

   
}
