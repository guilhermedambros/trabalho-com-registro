<?php

namespace App\Http\Requests;

use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Demanda;
use App\Helpers\Helpers;

class StoreDemandaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('demanda_criar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'descricao'     => ['required',],
            'pessoa_id' => ['required',],
            'valor_hora' => ['required',],
            'data_inicio' => ['required',],
        ];
    }

    //metodo utilizado caso haja necessidade de alterar algum campo antes de validar o form
    protected function prepareForValidation()
    {
        $this->merge([
            'valor_hora' => str_replace(',', '.', str_replace('.', '', $this->valor_hora)),
        ]);
    }
}
