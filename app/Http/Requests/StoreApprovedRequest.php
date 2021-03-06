<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApprovedRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            //'area_code' => 'required|string|max:2',   //Relaxed form
            //'phone' => 'required|string|max:10',      //Relaxed form
            'mobile' => 'required|string|max:11',
            'announcement' => 'required|string|max:8',
            'role_id' => 'required|exists:roles,id',
            'course_id' => 'required|exists:courses,id',
            'pole_id' => 'required|exists:poles,id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.max' => 'O nome deve ter no máximo 255 caracteres',
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'O e-mail deve ser válido',
            'email.max' => 'O e-mail deve ter no máximo 255 caracteres',
            'area_code.required' => 'O código de área é obrigatório',
            'area_code.max' => 'O código de área deve ter no máximo 2 caracteres',
            'phone.required' => 'O telefone é obrigatório',
            'phone.max' => 'O telefone deve ter no máximo 10 caracteres',
            'mobile.required' => 'O celular é obrigatório',
            'mobile.max' => 'O celular deve ter no máximo 11 caracteres',
            'announcement.required' => 'O edital é obrigatório',
            'announcement.max' => 'O edital deve ter no máximo 8 caracteres',
            'role_id.required' => 'A função é obrigatório',
            'role_id.exists' => 'A função deve estar entre as fornecidas',
            'course_id.required' => 'O curso é obrigatório',
            'course_id.exists' => 'O curso deve estar entre os fornecidos',
            'pole_id.required' => 'O pólo é obrigatório',
            'pole_id.exists' => 'O pólo deve estar entre os fornecidos',
        ];
    }
}
