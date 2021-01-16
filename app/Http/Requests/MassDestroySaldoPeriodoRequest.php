<?php

namespace App\Http\Requests;

use App\SaldoPeriodo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroySaldoPeriodoRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('saldo_periodo_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:saldo_periodos,id',
        ];
    }
}
