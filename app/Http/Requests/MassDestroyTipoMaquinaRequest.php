<?php

namespace App\Http\Requests;

use App\TipoMaquina;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyTipoMaquinaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tipo_maquina_excluir'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tipo_maquinas,id',
        ];
    }
}
