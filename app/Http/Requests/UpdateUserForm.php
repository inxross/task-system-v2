<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserForm extends FormRequest
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
            'user_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('App\User','name')->ignore($this->user->id),            //更新処理なので、自分のnameにはuniqueルールを適用したくないので。
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('App\User','email')->ignore($this->user->id),            //更新処理なので、自分のemailにはuniqueルールを適用したくないので。
            ],
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'ユーザー名',
            'email' => 'メールアドレス',
        ];
    }
}
