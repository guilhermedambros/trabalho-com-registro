<?php

namespace App\Http\Requests;

use App\Pessoa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StorePessoaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pessoa_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
                'unique:pessoas',
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
