<?php

namespace App\Http\Requests;

use App\Pessoa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use App\Helpers\Helpers;
use Illuminate\Validation\Rule;

class UpdatePessoaRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('pessoa_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'nome'     => [
                'string',
                'required',
            ],
            'email' => ['required', Rule::unique('pessoas')->whereNull('deleted_at')->where('id', '<>', request()->route('pessoa')->id)],
            'documento' => ['required', Rule::unique('pessoas')->whereNull('deleted_at')->where('id', '<>', request()->route('pessoa')->id)],
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
