<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends ApiValidationRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       $user=User::find($this->route('id'));
      
        return $user &&  $this->user()->can('update',$user);
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
            'user'=>'required|min:3|max:15', Rule::unique('users')->ignore(Auth::id()),
            'email'=>'required|email', Rule::unique('users')->ignore(Auth::id()),
            'password'=>'required|min:7|max:15',
            'active'=>'prohibited',
            'role_id'=>'prohibited'
        ];
    }
}
