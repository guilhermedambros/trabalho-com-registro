<?php

namespace App\Http\Requests;

use App\Servico;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class UpdateServicoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('servico_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'numero' => ['required', Rule::unique('servicos')->ignore($this->servico)],
            'descricao' => [
                'string',
                'required',
            ],
            'data_realizacao'  => [
                'string',
                'required',
            ],
            'beneficiario_pessoa_id'    => [
                'integer',
                'required',
            ],
        ];
    }
}
