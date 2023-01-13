<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserForm extends FormRequest
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
            'user_name' => 'required|string|max:255|unique:App\User,name',
            'email' => 'required|email|unique:App\User,email',
            'password' => 'required|string|confirmed|min:8',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'ユーザー名',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
