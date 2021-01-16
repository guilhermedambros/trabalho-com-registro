<?php

namespace App\Http\Requests;

use App\TipoMaquina;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Helpers\Helpers;

class UpdateTipoMaquinaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tipo_maquina_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'descricao'     => [
                'string',
                'required',
            ],
            'valor_hora_subsidiado' => [
                'string',
                'required',
            ]
            
        ];
    }

    //metodo utilizado caso haja necessidade de alterar algum campo antes de validar o form
    protected function prepareForValidation()
    {
        $this->merge([
            'valor_hora_subsidiado' => str_replace(',', '.', str_replace('.', '', $this->valor_hora_subsidiado)),
        ]);
    }
}
