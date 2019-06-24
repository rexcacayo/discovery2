<?php

namespace App\Http\Requests\Backend;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AcompananteRequest extends FormRequest
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
            'nombre' => ['required'],
        'cliente_id' => 'required|integer|exists:clientes,id',
            'cedula' => ['required'],
            'edad' => ['required'],
            'qsco' => ['required'],
            'ocupacion' => ['required'],

        ];
    }
}
