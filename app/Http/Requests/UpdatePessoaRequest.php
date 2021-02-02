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
            'nome' => ['string','required',],
            'data_associacao' => [Rule::requiredIf(in_array(1/*tipo associado*/, $this->input('tipo_pessoas', []))),],
            'endereco' => ['string','required',],
            'issqn' => [Rule::requiredIf(in_array(5/*tipo prestador*/, $this->input('tipo_pessoas', []))), 'numeric', 'between:0,100',],
            'email' => [Rule::unique('pessoas')->whereNull('deleted_at')->whereNotNull('email')->where('id', '<>', request()->route('pessoa')->id)],
            'documento' => [Rule::unique('pessoas')->whereNull('deleted_at')->whereNotNull('documento')->where('id', '<>', request()->route('pessoa')->id)],

            
        ];
    }

    //metodo utilizado caso haja necessidade de alterar algum campo antes de validar o form
    protected function prepareForValidation()
    {
        $this->merge([
            'documento' => Helpers::removeSpecialChar($this->documento),//remove caracteres do documento
            'telefone' => Helpers::removeSpecialChar($this->telefone),//remove caracteres do telefone
            'cep' => Helpers::removeSpecialChar($this->cep),//remove caracteres do cep
            'issqn' => str_replace(",",".",str_replace(".","",$this->issqn ?? 0))
        ]);
    }
}
