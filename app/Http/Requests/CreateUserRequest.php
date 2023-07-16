<?php

namespace App\Http\Requests;

class CreateUserRequest extends ApiValidationRequest
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
            'user'=>'required|min:3|max:15|unique:App\Models\User,user',
            'email'=>'required|email|unique:App\Models\User,email',
            'password'=>'required|min:7|max:15',
            'active'=>'prohibited',
            'role_id'=>'prohibited'
        ];
    }

  
}
