<?php

namespace App\Http\Requests;

use App\Demanda;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyDemandaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('demanda_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:demandas,id',
        ];
    }
}
