<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('user')->id;

        return [
            'email' => 'required|email|unique:users,email,' . $id . ',id',
            'password' => 'sometimes',
            'active' => 'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'O E-mail é obrigatório',
            'email.email' => 'O endereço de E-mail deve ser válido',
            'email.unique' => 'O endereço não pode ser igual a outro já cadastrado',
        ];
    }
}
