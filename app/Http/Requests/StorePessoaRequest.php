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
            'nome' => ['string','required',],
            'data_associacao' => ['string','required',],
            'endereco' => ['string','required',],
            'issqn' => [Rule::requiredIf(in_array(5/*tipo prestador*/, $this->input('tipo_pessoas', []))), 'numeric', 'between:0,100',],
            'email' => [Rule::unique('pessoas')->whereNull('deleted_at')->whereNotNull('email')],
            'documento' => [Rule::unique('pessoas')->whereNull('deleted_at')->whereNotNull('documento')],
        ];
    }

    //metodo utilizado caso haja necessidade de alterar algum campo antes de validar o form
    protected function prepareForValidation()
    {
        $this->merge([
            'documento' => Helpers::removeSpecialChar($this->documento),//remove caracteres do documento
            'telefone' => Helpers::removeSpecialChar($this->telefone),//remove caracteres do telefone
            'cep' => Helpers::removeSpecialChar($this->cep),//remove caracteres do cep
            'issqn' => str_replace(",",".",str_replace(".","",$this->issqn))
        ]);
    }
}
