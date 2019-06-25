<?php

namespace Shahnewaz\Redprint\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BuilderRequest extends FormRequest
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
            'model' => 'required',
            'migrations.*.field_name' => 'required',
            'migration.*.data_type' => 'required'
        ];
    }
}
