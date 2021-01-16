<?php

namespace App\Http\Requests;

use App\SaldoPeriodo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Helpers\Helpers;

class UpdateSaldoPeriodoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('saldo_periodo_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ano_exercicio'     => [
                'int',
                'required',
            ],
            'saldo_pesadas'    => [
                'int',
                'required',
            ],
            'saldo_leves' => [
                'int',
                'required',
            ]
        ];
    }

}
