<?php

namespace App\Http\Requests;

use App\Pessoa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdatePessoaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pessoa_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nome'     => [
                'string',
                'required',
            ],
            'email'    => [
                'required',
                'unique:pessoas,email,' . request()->route('pessoa')->id,
            ],
            'documento' => [
                'string',
                'required',
            ],
            'telefone'  => [
                'string',
                'required',
            ],
            'tipo_pessoa_id'    => [
                'integer',
            ],
        ];
    }
}
