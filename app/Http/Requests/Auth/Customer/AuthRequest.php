<?php

namespace App\Http\Requests\Auth\Customer;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'auth_input' => 'required|min:11|max:64|regex:/^[a-zA-Z0-9_.@\+]*$/'
        ];
    }

    /*  public function attributes(){
        return [
            'id' => 'ایمیل یا شماره موبایل'
        ];
    }*/
}
