<?php

namespace App\Http\Requests;

use App\Pessoa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Helpers\Helpers;
use Illuminate\Validation\Rule;
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
            /*'email'    => [
                'required',
                'unique:pessoas,id,deleted_at,NULL',
            ],*/
            'email' => ['required', Rule::unique('pessoas')->whereNull('deleted_at')],
            'documento' => ['required', Rule::unique('pessoas')->whereNull('deleted_at')],
            /*'documento' => [
                'string',
                'required',
                'unique:pessoas,id,deleted_at,NULL',
            ],*/
            'telefone'  => [
                'string',
                'required',
            ],
            'tipo_pessoa_id'    => [
                'integer',
            ],
        ];
    }

    //metodo utilizado caso haja necessidade de alterar algum campo antes de validar o form
    protected function prepareForValidation()
    {
        $this->merge([
            'documento' => Helpers::removeSpecialChar($this->documento),//remove caracteres do documento
            'telefone' => Helpers::removeSpecialChar($this->telefone),//remove caracteres do telefone
            'celular' => Helpers::removeSpecialChar($this->celular),//remove caracteres do celular
            'cep' => Helpers::removeSpecialChar($this->cep),//remove caracteres do cep
        ]);
    }
}
