<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoUpdateRequest extends FormRequest
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
            'ci' => 'unique:empleados,ci,' . $this->empleado->id,
            'email' => 'unique:users,email,' . $this->empleado->user->id,
        ];
    }

    public function messages()
    {
        return [
            'ci.unique' => 'Ya hay alguien registrado con este número de C.I..',
            'email.unique' => 'Ya hay alguien registrado con ese correo.',
        ];
    }
}
