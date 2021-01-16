<?php

namespace App\Http\Requests;

use App\Servico;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreServicoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('servico_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'descricao'  => [
                'string',
                'required',
            ],
            'endereco'  => [
                'string',
                'required',
            ],
            'data_realizacao'  => [
                'required',
            ],
            'numero'  => [
                'string',
                'required',
                'unique:servicos'
            ],
            'beneficiario_pessoa_id'    => [
                'integer',
                'required',
            ],
        ];
    }
}
